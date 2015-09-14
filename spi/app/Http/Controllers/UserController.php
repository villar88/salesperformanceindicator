<?php namespace App\Http\Controllers;

use App\ArchivedUser;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use App\User;
use App\ManagerUser;
use App\UserPassword;
use Illuminate\Http\RedirectResponse;

class UserController extends SecureController{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index( )
	{

            $requested = Input::get('request');
            if( $requested == null || $requested == '' || $requested == 'showAll' )
            {
                $users = $this->getActiveUsers();
                $keyword = '';
                return view('user.list', compact('users', 'keyword'));
            }
            else
            {
                $keyword = Input::get('keyword');
                $users = User::whereRaw(' ( first_name like ? or last_name like ? or email like ? ) order by first_name', array('%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%' ))->paginate(15)->appends(Input::except('page'));
                return view('user.list', compact('users', 'keyword'));
            }
	}

    private function getActiveUsers()
    {
        //return User::whereRaw('status IN ? order by first_name', array(' ( ACTIVE, NEW, RESET ) '))->paginate(15)->appends(Input::except('page'));
        //return User::whereIn('status', array('ACTIVE', 'INACTIVE', 'RESET', 'NEW'))->paginate(15)->appends(Input::except('page')); //->whereIn('salesType', $array);
        return User::paginate(15);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store( CreateUserRequest $request, User $user )
	{
        $password = $request->password;
        $user = new User();
        $request->offsetSet('password', bcrypt($request->password));
        $request->offsetSet('created_by', Auth::user()->id);
        $request->offsetSet('updated_by', Auth::user()->id);
        $request->offsetSet('status', "NEW");
        if($request->role_id!=2){
           $request->offsetSet('manager_id',0); 
        }
        $user->create( $request->all() );
        
        $user = DB::table('users')->where('email', $request->email)->first();
        $goal = parent::assembleGoalSetting();
        $goal->user_id = $user->id;
        $goal->save();

        $message = 'You have successfully Created '. $user->last_name . ', ' . $user->first_name ;
        //\Session::flash('message','You have successfully Created '. $user->last_name . ', ' . $user->first_name);
        $users = $users = $this->getActiveUsers();
        $keyword = '';
        
        $userPassword = new UserPassword();
        $userPassword->user_id=$user->id;
        $userPassword->crypt_password=\Crypt::encrypt($password);
        $userPassword->updated_at=new \DateTime();
        $userPassword->save();
        
        $contactEmail = $user->email;
        $contactName = $user->first_name . ' ' . $user->last_name;

        Mail::send('emails.hello', array( 'first_name' => $user->first_name, 'user_name' => $user->email, 'password' => $password ), function( $message ) use ($contactEmail, $contactName)
        {
            $message->from('no-reply@salesperformanceindicator.com', 'Sales Performance Indicator');
            $message->to($contactEmail, $contactName)->subject('Welcome to Sales Performance Indicator!');
        });
        
        \Session::flash('message','You have successfully Created '. $user->last_name . ', ' . $user->first_name);
        

        return view('user.list', compact('users', 'keyword'));
 	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return view('user.show',  ['user' => User::findOrFail($id)]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 */
	public function update(UpdateUserRequest $request, $id)
	{
        $band = false;
        $band2 = false;
        $user = User::findOrFail($id);
        $userPassword = UserPassword::whereRaw('user_id = ?', array( $id ))->first();
        $new_password = Input::get('new_password');
        if( $new_password != '' )
        {
            $band = true;
            $request->offsetSet('password', bcrypt($new_password));
            $userPassword->crypt_password=\Crypt::encrypt($new_password);
            
        }
        if($user->role_id!=2){
           $request->offsetSet('manager_id',0); 
        }
        if ($request->email != $user->email) {
            $band2 = true;
        }
        $user->update( $request->all());
        $userPassword->update();
        if ($band || $band2) {
            $contactEmail = $user->email;
            Mail::send('emails.resend', array('first_name' => $user->first_name, 'user_name' => $user->email, 'password' => $new_password), function( $message ) use ($contactEmail) {
                        $message->from('no-reply@salesperformanceindicator.com', 'Sales Performance Indicator');
                        $message->to($contactEmail, 'Sales Performance Indicator')->subject('Your Username and Password');
                    });
        } else {
            if ($band2) {
                $contactEmail = $user->email;
                $userPassword = UserPassword::whereRaw('user_id = ?', array($id))->first();
                $decrypted = \Crypt::decrypt($userPassword->crypt_password);
                Mail::send('emails.resend', array('first_name' => $user->first_name, 'user_name' => $user->email, 'password' => $decrypted), function( $message ) use ($contactEmail) {
                            $message->from('no-reply@salesperformanceindicator.com', 'Sales Performance Indicator');
                            $message->to($contactEmail, 'Sales Performance Indicator')->subject('Your Username and Password');
                        });
            }
        }
        \Session::flash('message','You have successfully Updated '. $user->last_name . ', ' . $user->first_name);
        return \Redirect::action('UserController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $user = User::findOrFail($id);

        $date=new \DateTime(); //this returns the current date time
        //$dtStr = $date->format('Y-m-d-H-i-s');

        //$user->email = $dtStr . '_' . $user->email;
        $user->status = 'INACTIVE';
        $user->inactive_date=$date;
        $user->save();
        \Session::flash('message','You have successfully disabled '. $user->last_name . ', ' . $user->first_name);
        $keyword = '';
        $users = $this->getActiveUsers();
        
        return view('user.list', compact('users', 'keyword'));
	}

    public function activate($id)
    {
        $user = User::findOrFail($id);

        $date=new \DateTime(); //this returns the current date time

        //$emailArr = explode('_', $user->email);

        //$user->email = $emailArr[1];
        $user->active_date=$date;
        $user->status = 'ACTIVE';
        $user->save();
        \Session::flash('message','You have successfully Activated '. $user->last_name . ', ' . $user->first_name);
        $keyword = '';
        $users = $this->getActiveUsers();
        return view('user.list', compact('users', 'keyword'));
    }


    public function reset($id)
    {
        $user = User::findOrFail($id);
        $userPassword = UserPassword::whereRaw('user_id = ?', array( $id ))->first();

        $date=new \DateTime(); //this returns the current date time
        $password = parent::randStrGen(8);

        $user->password =  bcrypt( $password );
        $userPassword->crypt_password=\Crypt::encrypt($password);
        $user->updated_by = Auth::user()->id;
        $user->status = 'RESET';
        $user->save();
        $userPassword->update();
        \Session::flash('message','You have successfully Reset '. $user->last_name . ', ' . $user->first_name . '\'s password. ');
        $message = 'You have successfully Reset '. $user->last_name . ', ' . $user->first_name . '\'s password. ';
        $keyword = '';
        $users = $this->getActiveUsers();

        $contactEmail = $user->email;
        $contactName = $user->first_name . ' ' . $user->last_name;
        Mail::send('emails.reset', array( 'first_name' => $user->first_name, 'last_name' => $user->last_name, 'user_name' => $contactEmail, 'password' => $password ), function( $message ) use ($contactEmail, $contactName)
        {
            $message->from('no-reply@salesperformanceindicator.com', 'Sales Performance Indicator');
            $message->to($contactEmail, $contactName)->subject('Password Reset');
        });

        return view('user.list', compact('users', 'keyword'));
    }
    

	public function findByCompany()
	{
            $companies = Input::get('companies');
            $status = Input::get('status');
            $keyword = '';
            if( $companies == null || $companies == 'default')
            {
                $users = $this->getActiveUsers();
                $companies = '';
                $status='';
                return view('user.list', compact('users', 'companies','keyword','status'));
            }
            else
            {
                if( $status == null || $status == 'ALL')
                {
                    $status='';
                    //$users = User::whereRaw(' ( company_id = ?  ) order by first_name', array($companies))->paginate(15)->appends(Input::except('page')); debe ser asi
                    $users = User::whereRaw(' ( company_id = ?  ) order by first_name', array($companies))->paginate(15)->appends(Input::except('page'));
                    return view('user.list', compact('users', 'companies','keyword','status'));
                }else{
                    //$users = User::whereRaw(' ( company_id = ?  ) order by first_name', array($companies))->paginate(15)->appends(Input::except('page')); debe ser asi
                    $users = User::whereRaw(' ( company_id = ?  and status = ?) order by first_name', array($companies,$status))->paginate(15)->appends(Input::except('page'));
                    return view('user.list', compact('users', 'companies','keyword','status'));
                }
            }
	}
        
        public function findByStatus()
	{
            $status = Input::get('status');
            $companies = Input::get('companies');
            $keyword = '';
            if( $status == null || $status == 'ALL')
            {
                $users = $this->getActiveUsers();
                $status = '';
                $companies='';
                return view('user.list', compact('users', 'status','keyword','companies'));
            }
            else
            {
                if( $companies == null || $companies == 'default'){
                    $companies='';
                    //$users = User::whereRaw(' ( company_id = ?  ) order by first_name', array($companies))->paginate(15)->appends(Input::except('page')); debe ser asi
                    $users = User::whereRaw(' ( status = ?  ) order by first_name', array($status))->paginate(100)->appends(Input::except('page'));
                    return view('user.list', compact('users', 'status','keyword','companies'));
                }else{
                    //$users = User::whereRaw(' ( company_id = ?  ) order by first_name', array($companies))->paginate(15)->appends(Input::except('page')); debe ser asi
                    $users = User::whereRaw(' ( status = ? and company_id = ? ) order by first_name', array($status,$companies))->paginate(100)->appends(Input::except('page'));
                    return view('user.list', compact('users', 'status','keyword','companies'));
                }
                
            }
	}
        
    public function support( $id )
    {
            $user = User::findOrFail($id);
            \Session::put('id_support', Auth::user()->id);
            $userPassword = UserPassword::whereRaw('user_id = ?', array( $id ))->first();
            $decrypted = \Crypt::decrypt($userPassword->crypt_password);
            Auth::logout();
            if(Auth::attempt(['email' => $user->email, 'password' => $decrypted])){
                \Session::put('support', 'true');
                return new RedirectResponse(url('/home'));
            }else{
                return new RedirectResponse(url('/home'));
            }
    }
    
    public function exitSupport()
    {
            Auth::logout();
            \Session::forget('support');
            $id = \Session::get('id_support');
            $user = User::findOrFail($id);
            $userPassword = UserPassword::whereRaw('user_id = ?', array( $id ))->first();
            $decrypted = \Crypt::decrypt($userPassword->crypt_password);
            if(Auth::attempt(['email' => $user->email, 'password' => $decrypted])){
                return new RedirectResponse(url('/home'));
            }else{
                return new RedirectResponse(url('/home'));
            }
    }

}
