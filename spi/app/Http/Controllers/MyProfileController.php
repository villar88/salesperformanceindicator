<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\UserPassword;

class MyProfileController extends SecureController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('myProfile.show',  ['user' => User::findOrFail(Auth::user()->id), 'message' => '']);
    }

    public function update( Requests\UpdateProfileRequest $request )
    {
        $user = User::findOrFail(Auth::user()->id);
        $userPassword = UserPassword::whereRaw('user_id = ?', array( Auth::user()->id ))->first();
        $new_password = Input::get('new_password');
        if( $new_password != '' )
        {
            $request->offsetSet('password', bcrypt($new_password));
            $userPassword->crypt_password=\Crypt::encrypt($new_password);
        }
        $user->status = 'ACTIVE';
        $date=new \DateTime();
        $user->active_date=$date;
        $user->update( $request->all());
        $userPassword->update();

        $message = 'You have successfully updated your Profile';
        return view('myProfile.show',  compact('user','message'));
    }


}
