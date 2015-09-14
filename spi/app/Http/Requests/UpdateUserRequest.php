<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends Request {

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
            $user_company_id = Auth::user()->company_id;
            $company_id = Request::input('company_id');
            return ($user_company_id == $company_id);
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
        $email = $this->input('email');
        $user = User::findOrFail($this->segment(2));
        if($user->email==$email){
            return [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'password' => 'min:5|max:20',
                'new_password' => 'min:5|same:confirm_password'
            ];
        }else{
            return [
                'email' => 'required|email|unique:users',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'password' => 'min:5|max:20',
                'new_password' => 'min:5|same:confirm_password'
            ];
        }
    }

}
