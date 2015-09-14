<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyRatioController extends SecureController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
                $recruiting=parent::getRecruiting($user->id,0);
                $clientDev=parent::getClientDev($user->id,0);
		$clientDevOut=parent::getClientDevOut($user->id,0);

		return view('myRatio.report', compact('recruiting', 'clientDev', 'clientDevOut'));
	}
        
        

}
