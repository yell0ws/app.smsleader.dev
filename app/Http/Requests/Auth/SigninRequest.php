<?php

namespace App\Http\Requests\Auth;

use Auth;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class SigninRequest extends Request
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
            'email.required' => Lang::get('auth.email.required'),
            'email.email' => Lang::get('auth.email.email'),
            'password.required' => Lang::get('auth.password.required'),
            'password.min' => Lang::get('auth.password.min'),
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

        if(Session::get('signincaptcha')) {
            return [
                'email' => 'required|email',
                'password' => 'required|min:5',
                'g-recaptcha-response' => 'required|recaptcha',
            ];
        }

        return [
            'email' => 'required|email',
            'password' => 'required|min:5|max:32',
        ];
    }
}
