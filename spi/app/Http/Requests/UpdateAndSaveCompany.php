<?php

namespace App\Http\Requests;

use App\User;
use App\Company;
use App\Http\Requests\Request;

class UpdateAndSaveCompany extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $type = $this->input('type_request');
        if ($type == 0) {
            return [
                'name' => 'required|max:255|unique:companies',
                'email' => 'required|email|unique:users',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'password' => 'required|min:5|max:20|same:confirm_password',
                'confirm_password' => 'required|min:5'
            ];
        } else {
            $email = $this->input('email');
            $name = $this->input('name');
            $user_id = $this->input('user_id');
            $company_id = $this->input('company_id');
            $company = Company::findOrFail($company_id);
            $user = User::findOrFail($user_id);
            if ($user->email == $email) {
                if ($company->name == $name) {
                    return [
                        'first_name' => 'required|max:255',
                        'last_name' => 'required|max:255',
                        'password' => 'min:5|max:20',
                        'new_password' => 'min:5|same:confirm_password'
                    ];
                } else {
                    return [
                        'name' => 'required|max:255|unique:companies',
                        'first_name' => 'required|max:255',
                        'last_name' => 'required|max:255',
                        'password' => 'min:5|max:20',
                        'new_password' => 'min:5|same:confirm_password'
                    ];
                }
            } else {
                if ($company->name == $name) {
                    return [
                        'email' => 'required|email|unique:users',
                        'first_name' => 'required|max:255',
                        'last_name' => 'required|max:255',
                        'password' => 'min:5|max:20',
                        'new_password' => 'min:5|same:confirm_password'
                    ];
                } else {
                    return [
                        'name' => 'required|max:255|unique:companies',
                        'email' => 'required|email|unique:users',
                        'first_name' => 'required|max:255',
                        'last_name' => 'required|max:255',
                        'password' => 'min:5|max:20',
                        'new_password' => 'min:5|same:confirm_password'
                    ];
                }
            }
        }
    }

}
