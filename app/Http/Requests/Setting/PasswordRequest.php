<?php

namespace App\Http\Requests\Setting;

use Auth;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class PasswordRequest extends Request{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){

        return Auth::check();

    }

     /**
     * Set the validation messages.
     *
     * @return array
     */
    public function messages(){
        
        return [
            'old_password.required' => Lang::get('setting.password.old_password.required'),
            'old_password.min' => Lang::get('setting.password.old_password.min'),
            'old_password.max' => Lang::get('setting.password.old_password.max'),
            'new_password.required' => Lang::get('setting.password.new_password.required'),
            'new_password.min' => Lang::get('setting.password.new_password.min'),
            'new_password.max' => Lang::get('setting.password.new_password.max'),
            'new_password.different' => Lang::get('setting.password.new_password.different'),
            'new_password.confirmed' => Lang::get('setting.password.new_password.confirmed'),
            'new_password_confirmation.required' => Lang::get('setting.password.new_password_confirmation.required'),
        ];

    }


    /**
     * Set the attributes field to the validation.
     *
     * @return array
     */
    public function attributes(){
        
        return [];

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){

        return [
            'old_password' => 'required|min:5|max:32',
            'new_password' => 'required|min:5|max:32|different:old_password|confirmed',
            'new_password_confirmation' => 'required',
        ];
        
    }
}
