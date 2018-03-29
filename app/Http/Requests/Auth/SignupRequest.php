<?php

namespace App\Http\Requests\Auth;

use Auth;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class SignupRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            return false;
        }

        return true;
    }

     /**
     * Set the validation messages.
     *
     * @return array
     */
    public function messages()
    {
        
        return [
            'username.required' => Lang::get('auth.username.required'),
            'username.alpha_num' => Lang::get('auth.username.alpha_num'),
            'username.min' => Lang::get('auth.username.min'),
            'username.max' => Lang::get('auth.username.max'),
            'username.unique' => Lang::get('auth.username.unique'),
            'email.required' => Lang::get('auth.email.required'),
            'email.unique' => Lang::get('auth.email.unique'),
            'password.required' => Lang::get('auth.password.required'),
            'password.confirmed' => Lang::get('auth.password.confirmed'),
            'password.min' => Lang::get('auth.password.min'),
            'password_confirmation.required' => Lang::get('auth.password_confirmation.required'),
            'g-recaptcha-response.required' => Lang::get('auth.g-recaptcha-response.required'),
        ];
    }


    /**
     * Set the attributes field to the validation.
     *
     * @return array
     */
    public function attributes()
    {
        
        return [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|alpha_num|min:5|max:32|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:32|confirmed',
            'password_confirmation' => 'required',
            'rule_accept' => 'accepted',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }
}
