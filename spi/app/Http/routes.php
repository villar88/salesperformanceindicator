<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

Route:get('/', function(){

    if(Auth::guest()){
        return Redirect::to('auth/login');
    }
    $user = Auth::user();

    if( $user->company->status == 'INACTIVE' )
    {
        return Redirect::to('auth/login');
    }

    $status = $user->status;

    if( $status == 'RESET' || $status == 'NEW' )
    {
        return Redirect::to('myprofile');
    }

    $role = $user->role->id;

    if( $role == 1 ){
        return Redirect::to('users');
    }
    elseif( $role == 4 ){
        return Redirect::to('companyUsers');
    }
    elseif( $role == 3 ){
        return Redirect::to('companyUsers');
    }
    elseif( $role == 2 ){
        return Redirect::to('myStats');
    }

});

Route::post('infusion/createUser', 'InfusionController@createUser');
Route::post('infusion/deactivate', 'InfusionController@deactivate');

Route::any('users/search', 'UserController@index');
Route::any('users/exitSupport', 'UserController@exitSupport');
Route::any('companyUsers/search', 'CompanyUserController@index');
Route::any('companyUsers/destroy/{id}', 'CompanyUserController@destroy');
Route::any('companyUsers/activate/{id}','CompanyUserController@activate');
Route::any('companyUsers/reset/{id}', 'CompanyUserController@reset');
Route::any('companyUsers/test', 'CompanyUserController@test');
Route::any('companies/search', 'CompanyController@index');
Route::any('companies/destroy/{id}', 'CompanyController@destroy');
Route::any('companies/activate/{id}', 'CompanyController@activate');
Route::any('companies/delete/{id}', 'CompanyController@delete');
Route::any('goalSettings/search', 'GoalSettingController@index');
Route::any('goalSettings/edit/{id}', 'GoalSettingController@edit');
Route::post('goalSettings/updateAll', 'GoalSettingController@updateAll');

Route::get('home', function(){
    return Redirect::to('/');
});

Route::resource('users','UserController');
Route::any('/users/destroy/{id}','UserController@destroy');
Route::any('/users/activate/{id}','UserController@activate');
Route::any('/users/reset/{id}','UserController@reset');
Route::any('/users/support/{id}','UserController@support');
Route::resource('companies','CompanyController');
Route::resource('companyUsers','CompanyUserController');
Route::resource('myRatio', 'MyRatioController');
Route::any('/companyUsers/statistics/{id}','CompanyUserController@statistics');
Route::resource('goalSettings','GoalSettingController');

Route::any('/licenses/list/{id}', 'LicenseController@index');
Route::any('/licenses/destroy/{id}','LicenseController@destroy');
Route::any('/licenses/activate/{id}','LicenseController@activate');
Route::any('/licenses/create/{id}', 'LicenseController@create');
Route::any('/licenses/remove/{id}', 'LicenseController@remove');
Route::any('/licenses/shoppingcart', 'LicenseController@shoppingcart');
Route::resource('licenses','LicenseController');

Route::get('/training', 'TrainingController@index');
Route::resource('training','TrainingController');

Route::any('/companyUsers/create/{id}', 'CompanyUserController@adminCreate');
Route::any('/companyUsers/show/{id}', 'CompanyUserController@show');
Route::any('/companyUsers/sendEmail/{id}','CompanyUserController@sendEmail');
Route::any('/companyUsers/shoppingCar','CompanyUserController@shoppingCar');

Route::any('/myStats', 'MyStatsController@index');
Route::post('myStats/add', 'MyStatsController@add');
Route::post('myStats/addSales', 'MyStatsController@addSales');

Route::get('/prodSales', 'ProductionSalesRptController@index');
Route::get('/myprofile', 'MyProfileController@index');
Route::any('/myProfile/update', 'MyProfileController@update');
Route::any('/users/searchById', 'UserController@findByCompany');//jose rojas
Route::any('/users/searchByStatus', 'UserController@findByStatus');//jose rojas
Route::resource('reports','ReportsController');//jose rojas
Route::any('reports/search', 'ReportsController@index');//jose rojas
Route::any('/reports/searchByStatus', 'ReportsController@findByStatus');//eliminar
Route::resource('myLicences','MyLicensesController');//jose rojas
Route::any('myLicences/search', 'MyLicensesController@index');//jose rojas
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('dropdown', function(){
	$id = Input::get('option');
	$managers = \App\User::where('role_id',3)->where('company_id',$id)->orderBy('first_name')->lists('first_name', 'id');
	return $managers;
});

Route::get('updateGoals', function(){
    
        try{
            $id_goals_managers = Input::get('id_goals_managers');//id for goals_managers
            $month = Input::get('month');
            $amount = Input::get('amount');
            
            if($month != 'annual'){

                $goalManagements = \App\GoalManagement::findOrFail($id_goals_managers);

                if($goalManagements){

                    switch ($month) {
                        case "jan":
                            $goalManagements->jan = $amount;
                            break;
                        case "feb":
                            $goalManagements->feb = $amount;
                            break;
                        case "mar":
                            $goalManagements->mar = $amount;
                            break;
                        case "apr":
                            $goalManagements->apr = $amount;
                            break;
                        case "may":
                            $goalManagements->may = $amount;
                            break;
                        case "jun":
                            $goalManagements->jun = $amount;
                            break;
                        case "jul":
                            $goalManagements->jul = $amount;
                            break;
                        case "aug":
                            $goalManagements->aug = $amount;
                            break;
                        case "sep":
                            $goalManagements->sep = $amount;
                            break;
                        case "oct":
                            $goalManagements->oct = $amount;
                            break;
                        case "nov":
                            $goalManagements->nov = $amount;
                            break;
                        case "dic":
                            $goalManagements->dic = $amount;
                            break;
                    }

                    $goalManagements->annual = $goalManagements->jan + $goalManagements->feb +
                            $goalManagements->mar+$goalManagements->apr+$goalManagements->may+
                            $goalManagements->jun+$goalManagements->jul+
                            $goalManagements->aug+$goalManagements->sep + $goalManagements->oct+
                            $goalManagements->nov + $goalManagements->dec;

                    $goalManagements->save();
                    echo "true";
                }else{
                    echo "false";
                }
            
            }else{
                $goalManagements = \App\GoalManagement::findOrFail($id_goals_managers);

                if($goalManagements){
                    $goalManagements->annual = $amount;
                    $goalManagements->jan = $amount/12;
                    $goalManagements->feb = $amount/12;
                    $goalManagements->mar = $amount/12;
                    $goalManagements->apr = $amount/12;
                    $goalManagements->may = $amount/12;
                    $goalManagements->jun = $amount/12;
                    $goalManagements->jul = $amount/12;
                    $goalManagements->aug = $amount/12;
                    $goalManagements->sep = $amount/12;
                    $goalManagements->oct = $amount/12;
                    $goalManagements->nov = $amount/12;
                    $goalManagements->dec = $amount/12;
                    
                    $goalManagements->save();
                    echo "true";
                }else{
                    echo "false";
                }
            }
        }catch(Exception $e){
            echo "false";
        }
});

Route::get('prueba', function(){
	$id = Input::get('user_id');
	$data = DB::table('sales')
            ->select(DB::raw('sum(sales.sale) as monthlyTotal, sales.month'))
            ->where('sales.user_id', '=', $id)
            ->where('sales.saleType_id', '=', 1)
            ->where('sales.year', '=', date("Y"))
            ->groupBy('sales.month')
            ->get();

        $array = array();
        $annualTotal = 0;
        foreach ( $data as $datum )
        {
            $array[ $this->getMonth( $datum->month )] = $datum->monthlyTotal;
            $annualTotal += $datum->monthlyTotal;
        }
        $array['annual'] = $annualTotal;
        return $array;
});