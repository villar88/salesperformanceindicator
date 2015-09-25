<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\User;
use App\License;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\UserPassword;

class CompanyController extends SecureController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $requested = Input::get('request');
        if ($requested == null || $requested == '' || $requested == 'showAll') {
            $companies = Company::orderBy('name')->paginate(15);
            $keyword = '';
        } else {
            $keyword = Input::get('keyword');
            $companies = Company::whereRaw('name like ? order by name', array('%' . $keyword . '%'))->paginate(15)->appends(Input::except('page'));
        }
        return view('company.list', compact('companies', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\UpdateAndSaveCompany $request, Company $company) {
        $request->offsetSet('created_by', Auth::user()->id);
        $request->offsetSet('updated_by', Auth::user()->id);
        $request->offsetSet('status', 'ACTIVE');
        $company->create($request->all());
        $company = DB::table('companies')->where('name', $request->name)->first();
        $password = $request->password;
        $user = new User();
        $request->offsetSet('password', bcrypt($request->password));
        $request->offsetSet('created_by', Auth::user()->id);
        $request->offsetSet('updated_by', Auth::user()->id);
        $request->offsetSet('status', "NEW");
        $request->offsetSet('role_id', "4");
        $request->offsetSet('manager_id', 0);
        $request->offsetSet('company_id', $company->id);
        $user->create($request->all());

        $user = DB::table('users')->where('email', $request->email)->first();
        $goal = parent::assembleGoalSetting();
        $goal->user_id = $user->id;
        $goal->created_by=Auth::user()->id;
        $goal->updated_by=Auth::user()->id;
        $goal->save();

        $userPassword = new UserPassword();
        $userPassword->user_id = $user->id;
        $userPassword->crypt_password = \Crypt::encrypt($password);
        $userPassword->updated_at = new \DateTime();
        $userPassword->created_at = new \DateTime();
        $userPassword->save();

        $contactEmail = $user->email;
        $contactName = $user->first_name . ' ' . $user->last_name;

        Mail::send('emails.hello', array('first_name' => $user->first_name, 'user_name' => $user->email, 'password' => $password), function( $message ) use ($contactEmail, $contactName) {
            $message->from('no-reply@salesperformanceindicator.com', 'Sales Performance Indicator');
            $message->to($contactEmail, $contactName)->subject('Welcome to Sales Performance Indicator!');
        });

        \Session::flash('message', 'You have successfully Created ' . $company->name);
        $companies = Company::orderBy('name')->paginate(15);
        $keyword = '';
        return view('company.list', compact('companies', 'keyword'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $company = Company::findOrFail($id);
        $message = '';
        $user = DB::table('users')->where('company_id', $id)->where('role_id', 4)->first();
        $company->email=$user->email;
        $company->first_name=$user->first_name;
        $company->last_name=$user->last_name;
        $company->contact_number=$user->contact_number;
        $company->address1=$user->address1;
        $company->address2=$user->address2;
        $company->user_id=$user->id;
        $users = User::whereRaw('company_id = ? order by first_name', array($company->id))->paginate(15)->appends(Input::except('page'));

        return view('company.show', ['company' => $company, 'users' => $users, 'message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(Requests\UpdateAndSaveCompany $request, $id) {
        $company = Company::findOrFail($id);
        $company->update($request->all());
        
        $band = false;
        $band2 = false;
        $user = User::findOrFail($request->user_id);
        $userPassword = UserPassword::whereRaw('user_id = ?', array( $user->id ))->first();
        $new_password = Input::get('new_password');
        if( $new_password != '' )
        {
            $band = true;
            $request->offsetSet('password', bcrypt($new_password));
            $userPassword->crypt_password=\Crypt::encrypt($new_password);
            
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
                $userPassword = UserPassword::whereRaw('user_id = ?', array($user->id))->first();
                $decrypted = \Crypt::decrypt($userPassword->crypt_password);
                Mail::send('emails.resend', array('first_name' => $user->first_name, 'user_name' => $user->email, 'password' => $decrypted), function( $message ) use ($contactEmail) {
                            $message->from('no-reply@salesperformanceindicator.com', 'Sales Performance Indicator');
                            $message->to($contactEmail, 'Sales Performance Indicator')->subject('Your Username and Password');
                        });
            }
        }

        \Session::flash('message', 'You have successfully Updated ' . $company->name);
        return \Redirect::action('CompanyController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $company = Company::findOrFail($id);
        $date = new \DateTime(); //this returns the current date time
        $company->status = 'INACTIVE';
        $company->save();
        DB::table('users')
                ->where('company_id', $id)
                ->update(array('status' => 'INACTIVE', 'inactive_date' => $date));
        \Session::flash('message', 'You have successfully disabled ' . $company->name);
        $keyword = '';
        $companies = Company:: paginate(15);
        return view('company.list', compact('companies', 'keyword'));
    }

    public function activate($id) {
        $company = Company::findOrFail($id);
        $company->status = 'ACTIVE';
        $company->save();
        $date = new \DateTime();
        DB::table('users')
                ->where('company_id', $id)
                ->update(array('status' => 'ACTIVE', 'active_date' => $date));
        \Session::flash('message', 'You have successfully activated ' . $company->name);
        $keyword = '';
        $companies = Company:: paginate(15);
        return view('company.list', compact('companies', 'keyword'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id) {
        $company = Company::findOrFail($id);
        
        //goals
        DB::table('goal_managements')->whereIn('user_id', function($query) use ($company)
        {
            $query->select('id')
                  ->from('users')
                  ->whereRaw('users.company_id = ?',array($company->id));
        })->delete();
        
        //points
        DB::table('points')->where('company_id', '=', $company->id)->delete();
        
        //points_audit
        DB::table('point_audits')->where('company_id', '=', $company->id)->delete();
        
        //sales
        DB::table('sales')->where('company_id', '=', $company->id)->delete();
        
        //sales_audits
        DB::table('sale_audits')->where('company_id', '=', $company->id)->delete();
        
        //user_passwords
        DB::table('user_passwords')->whereIn('user_id', function($query) use ($company)
        {
            $query->select('id')
                  ->from('users')
                  ->whereRaw('users.company_id = ?',array($company->id));
        })->delete();
        
        //users
        DB::table('users')->where('company_id', '=', $company->id)->delete();
        
        //company
        DB::table('companies')->where('id', '=', $company->id)->delete();

        \Session::flash('message', 'You have successfully delete ' . $company->name);
        $keyword = '';
        $companies = Company:: paginate(15);
        return view('company.list', compact('companies', 'keyword'));
    }

}
