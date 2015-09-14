<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\UserPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\License;

class CompanyUserController extends SecureController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $requested = Input::get('request');
        $message = '';
        if ($requested == null || $requested == '' || $requested == 'showAll') {

            $keyword = '';
            $users = $this->getActiveCompanyUsers(null);
        } else {
            $keyword = Input::get('keyword');
            $users = $this->getActiveCompanyUsers($keyword);
        }
        $cont = 0;
        foreach ($users as $user) {
            $users[$cont]->cont = $cont;
            $directHire[] = parent::getDirectHire($user->id,0);
            $directHireTarget[] = parent::getDirectHireTarget($user->id);
            $gmp[] = parent::getGMP($user->id,0);
            $gmpAnnual[] = parent::getGMPAnnual($user->id,0);
            $recruiting[] = parent::getRecruiting($user->id,0);
            $clientDev[] = parent::getClientDev($user->id,0);
            $clientDevOut[] = parent::getClientDevOut($user->id,0);
            $pointMonthly[] = parent::getPointMonthly($user->id,0);
            $pointDaily[] = parent::getPointDaily($user->id,0);
            $today_total[] = parent::getTodaysStats2($user->id,0);
            $avg[] = parent::getAvgPoints($user->id,0);
            $directHireAnnual[] = parent::getDirectHireAnnual($user->id,0);
            $cont++;
        }
        $activeTab = 'users';
        $directHireAll = parent::getDirectHire(0,1);
        $directHireTargetAll = parent::getDirectHireTarget(0);
        $gmpAll = parent::getGMP(0,1);
        $gmpAnnualAll = parent::getGMPAnnual(0,1);
        $recruitingAll = parent::getRecruiting(0,1);
        $clientDevAll = parent::getClientDev(0,1);
        $clientDevOutAll = parent::getClientDevOut(0,1);
        $pointMonthlyAll = parent::getPointMonthly(0,1);
        $pointDailyAll = parent::getPointDaily(0,1);
        $todayTotalAll = parent::getTodaysStats2(0,1);
        $directHireAnnualAll = parent::getDirectHireAnnual(0,1);
        $avgAll = parent::getAvgPoints(0,1);
        /* echo '<pre>';
          print_r($pointDaily);
          echo '</pre>';
          exit(); */
        return view('companyUser.list', 
                compact(
                        'users', 'keyword', 'message', 'directHire', 'directHireTarget',
                        'gmp', 'gmpAnnual','recruiting', 'clientDev', 'clientDevOut', 
                        'pointMonthly', 'pointDaily', 'today_total', 'avg', 'activeTab','directHireAll',
                        'directHireTargetAll','gmpAll','gmpAnnualAll','recruitingAll','clientDevAll',
                        'clientDevOutAll','pointMonthlyAll','pointDailyAll','todayTotalAll','avgAll',
                        'directHireAnnual','directHireAnnualAll'));
    }

    private function getActiveCompanyUsers($keyword) {
        $role_id = Auth::user()->role_id;
        $company_id = Auth::user()->company_id;
        $manager_id = Auth::user()->id;
        $filter = '';
        if ($role_id == 3) {
            $filter = ' and role_id in( 2 ) ';
            if (empty($keyword)) {
                return User::whereRaw('company_id = ? and manager_id = ? ' . $filter . ' order by first_name', array($company_id, $manager_id))->paginate(15)->appends(Input::except('page'));
            } else {
                return User::whereRaw(' ( first_name like ? or last_name like ? or email like ? ) and company_id = ? and manager_id = ?  ' . $filter . ' order by first_name', array('%' . $keyword . '%', '%' . $keyword . '%', '%' . $keyword . '%', $company_id, $manager_id))->paginate(15)->appends(Input::except('page'));
            }
        } elseif ($role_id == 4) {
            $filter = ' and role_id in( 2, 3 ) ';
            if (empty($keyword)) {
                return User::whereRaw('company_id = ? ' . $filter . ' order by first_name', array(Auth::user()->company_id))->paginate(15)->appends(Input::except('page'));
            } else {
                return User::whereRaw(' ( first_name like ? or last_name like ? or email like ? ) and company_id = ? ' . $filter . ' order by first_name', array('%' . $keyword . '%', '%' . $keyword . '%', '%' . $keyword . '%', $company_id))->paginate(15)->appends(Input::except('page'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $company = Company::findOrFail(Auth::user()->company_id);
        $user = new User();
        return view('companyUser.create', compact('company', 'user'));
    }

    public function adminCreate($id) {
        $company = Company::findOrFail($id);
        return view('companyUser.create', ['company' => $company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\CreateUserRequest $request, User $user) {
        $license = License::whereRaw('company_id = ? and status = "ACTIVE" and user_id = 0', array(Auth::user()->company_id))->first();
        if (!isset($license->id)) {
            \Session::flash('message', 'You have not Licenses');
            return Redirect::action('CompanyUserController@index');
        }
        $password = $request->password;

        $user = new User();
        $request->offsetSet('password', bcrypt($request->password));
        $request->offsetSet('created_by', Auth::user()->id);
        $request->offsetSet('updated_by', Auth::user()->id);
        $request->offsetSet('status', "NEW");
        if ($request->role_id != 2) {
            $request->offsetSet('manager_id', 0);
        }
        if (Auth::user()->role->id == 3) {
            $request->offsetSet('manager_id', Auth::user()->id);
        }
        $user->create($request->all());

        $user = DB::table('users')->where('email', $request->email)->first();
        $goal = parent::assembleGoalSetting();
        $goal->user_id = $user->id;
        $goal->created_by = Auth::user()->id;
        $goal->updated_by = Auth::user()->id;
        $goal->save();

        $license->user_id = $user->id;
        $license->update();

        $contactEmail = $user->email;

        Mail::send('emails.hello', array('first_name' => $user->first_name, 'user_name' => $user->email, 'password' => $password), function( $message ) use ($contactEmail) {
            $message->from('no-reply@salesperformanceindicator.com', 'Sales Performance Indicator');
            $message->to($contactEmail, 'Sales Performance Indicator')->subject('Welcome to Sales Performance Indicator!');
        });
        
        \Session::flash('message', 'You have successfully created ' . $user->last_name . ', ' . $user->first_name);
        return Redirect::action('CompanyUserController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return view('companyUser.show', ['user' => User::findOrFail($id)]);
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
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\UpdateUserRequest $request, $id) {
        $band = false;
        $band2 = false;
        $user = User::findOrFail($id);
        $userPassword = UserPassword::whereRaw('user_id = ?', array($id))->first();

        $new_password = $request->new_password;
        if ($new_password != '') {
            $band = true;
            $request->offsetSet('password', bcrypt($new_password));
            $userPassword->crypt_password = \Crypt::encrypt($new_password);
        }
        if ($user->role_id != 2) {
            $request->offsetSet('manager_id', 0);
        }
        if ($request->email != $user->email) {
            $band2 = true;
        }
        $user->update($request->all());
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
        \Session::flash('message', 'You have successfully updated ' . $user->last_name . ', ' . $user->first_name);
        return Redirect::action('CompanyUserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $user = User::findOrFail($id);

        $date = new \DateTime(); //this returns the current date time
        //$dtStr = $date->format('Y-m-d-H-i-s');
        //$user->email = $dtStr . '_' . $user->email;
        $user->status = 'INACTIVE';
        $user->inactive_date = $date;
        $user->save();
        $user_role = Auth::user()->role->id;
        $users = $this->getActiveCompanyUsers(null);
        $message = 'You have successfully disabled ' . $user->last_name . ', ' . $user->first_name;
        if ($user_role == 1) {
            $company = Company::findOrFail(Auth::user()->company_id);
            return view('company.show', ['company' => $company, 'users' => $users, 'message' => $message]);
        } else {
            $keyword = '';
            \Session::flash('message', 'You have successfully disabled ' . $user->last_name . ', ' . $user->first_name);
            return Redirect::action('CompanyUserController@index');
        }
    }

    public function activate($id) {
        $user = User::findOrFail($id);

        $date = new \DateTime(); //this returns the current date time
        //$emailArr = explode('_', $user->email);
        //$user->email = $emailArr[1];
        $user->active_date = $date;
        $user->status = 'ACTIVE';
        $user->save();
        \Session::flash('message', 'You have successfully Activated ' . $user->last_name . ', ' . $user->first_name);

        return Redirect::action('CompanyUserController@index');
    }

    public function statistics($id) {
        $user = User::findOrFail($id);
        $directHire = parent::getDirectHire($user->id);
        $directHireAnnual = parent::getDirectHireAnnual($user->id,0);
        $directHireTarget = parent::getDirectHireTarget($user->id);
        $gmp = parent::getGMP($user->id);
        $gmpAnnual = parent::getGMPAnnual($user->id);
        return view('prodSales.report', compact('directHireTarget', 'directHireAnnual', 'directHire', 'gmp', 'gmpAnnual', 'user'));
    }

    public function reset($id) {
        $user = User::findOrFail($id);
        $userPassword = UserPassword::whereRaw('user_id = ?', array($id))->first();
        $date = new \DateTime(); //this returns the current date time
        $password = parent::randStrGen(8);

        $user->password = bcrypt($password);
        $userPassword->crypt_password = \Crypt::encrypt($password);
        $user->updated_by = Auth::user()->id;
        $user->status = 'RESET';
        $user->save();
        $userPassword->update();
        $message = 'You have successfully Reset ' . $user->last_name . ', ' . $user->first_name . '\'s password. ';
        \Session::flash('message', 'You have successfully Reset ' . $user->last_name . ', ' . $user->first_name . '\'s password. ');

        $contactEmail = $user->email;
        $contactName = $user->first_name . ' ' . $user->last_name;
        Mail::send('emails.reset', array('first_name' => $user->first_name, 'last_name' => $user->last_name, 'user_name' => $contactEmail, 'password' => $password), function( $message ) use ($contactEmail, $contactName) {
            $message->from('no-reply@salesperformanceindicator.com', 'Sales Performance Indicator');
            $message->to($contactEmail, $contactName)->subject('Password Reset');
        });

        return Redirect::action('CompanyUserController@index');
    }

    public function sendEmail($id) {
        $user = User::findOrFail($id);
        $userPassword = UserPassword::whereRaw('user_id = ?', array($id))->first();
        $decrypted = \Crypt::decrypt($userPassword->crypt_password);
        $contactEmail = $user->email;
        Mail::send('emails.resend', array('first_name' => $user->first_name, 'user_name' => $user->email, 'password' => $decrypted), function( $message ) use ($contactEmail) {
            $message->from('no-reply@salesperformanceindicator.com', 'Sales Performance Indicator');
            $message->to($contactEmail, 'Sales Performance Indicator')->subject('Your Username and Password');
        });
        \Session::flash('message', 'You have successfully send a username and password for  ' . $user->last_name . ', ' . $user->first_name);
        return Redirect::action('CompanyUserController@index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function test() {
        if (isset($_POST['first_name'])) {
            require_once("src/isdk.php");
            $app = new iSDK;
            $contact = array(
                "FirstName" => $_POST['first_name'],
                "LastName" => $_POST['last_name'],
                "State" => $_POST['state'],
                "Phone1" => $_POST['phoneNumber'],
                "City" => $_POST['city'],
                "Email" => $_POST['emailAddress'],
                "Address1Type" => $_POST['addressLine1'],
                "ZipFour1" => $_POST['last_name'],
                "Country" => $_POST['last_name'],
                "Company" => $_POST['company'],
            );
            $contact_ID = $app->addCon($contact);
            echo $contact_ID;
            exit;
        }


        return view('companyUser.test');
    }

}
