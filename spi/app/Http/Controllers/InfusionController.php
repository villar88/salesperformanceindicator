<?php namespace App\Http\Controllers;

use App\GoalManagement;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class InfusionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function deactivate( )
	{

		if( Input::get('SecretKey') != '1nfus10n5P!')
		{
			return Response::json(array('error' => 'Invalid Key'));
		}

		$user = User::where('email', '=', Input::get('email') )->firstOrFail();
		$user->status = 'INACTIVE';
		$user->save();

		return $user;
	}

	public function assembleGoalSetting()
	{
		$goal = new GoalManagement();
		$default_sales = 10000;
		$goal->jan = $default_sales;
		$goal->feb = $default_sales;
		$goal->mar = $default_sales;
		$goal->apr = $default_sales;
		$goal->may = $default_sales;
		$goal->jun = $default_sales;
		$goal->jul = $default_sales;
		$goal->aug = $default_sales;
		$goal->sep = $default_sales;
		$goal->oct = $default_sales;
		$goal->nov = $default_sales;
		$goal->dec = $default_sales;
		$goal->annual = ( $default_sales * 12 );
		return $goal;
	}

	public function createUser()
	{
		if( Input::get('SecretKey') != '1nfus10n5P!')
		{
			return Response::json(array('error' => 'Invalid Key'));
		}


		$password = Input::get('password');
		$user = new User();

		$user->last_name = Input::get('last_name');
		$user->first_name = Input::get('first_name');
		$user->email = Input::get('email');
		$user->password = bcrypt(Input::get('password'));
		$user->role_id = Input::get('role_id');
		$user->address1 = Input::get('address1');
		$user->address2 = Input::get('address2');
		$user->contact_number = Input::get('contact_number');
		$user->company_id = Input::get('company_id');

		$user->status = 'NEW';
		$user->created_by = 1;
		$user->updated_by = 1;
		$user->save();

		$user = DB::table('users')->where('email', Input::get('email'))->first();
		$goal = $this->assembleGoalSetting();
		$goal->user_id = $user->id;
		$goal->save();


		 return Response::json(array('email' => $user->email, 'password' => Input::get('password'), 'status' => $user->status, 'last_name' => $user->last_name, 'first_name' => $user->first_name));;
	}
}
