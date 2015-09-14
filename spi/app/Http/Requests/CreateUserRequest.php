<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        $role = Auth::user()->role->id;

        if( $role == 1 )
        {
            return true;
        }
        elseif ( $role == 4 || $role == 3 )
        {
            $uer_company_id = Auth::user()->company_id;
            $company_id = Request::input('company_id');
            return ($uer_company_id == $company_id);
        }

        return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'email' => 'required|email|unique:users',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'password' => 'required|min:5|max:20|same:confirm_password',
            'confirm_password' => 'required|min:5'
		];
	}

}
