<?php

namespace App\Http\Requests\Auth;

use Auth;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class PasswordForgotRequest extends Request
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
            'email.required' => Lang::get('auth.email.required'),
            'email.email' => Lang::get('auth.email.min'),
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

        if(Session::get('forgotcaptcha')) {
            return [
                'username' => 'required|alpha_num|min:5|max:32',
                'email' => 'required|email',
                'g-recaptcha-response' => 'required|recaptcha',
            ];
        }

        return [
            'username' => 'required|alpha_num|min:5|max:32',
            'email' => 'required|email',
        ];
    }
}
