<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateProfileRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'password' => 'min:5|max:20',
            'new_password' => 'min:5|same:confirm_password'
        ];
	}

}
