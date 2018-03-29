<?php

namespace App\Http\Requests\Setting;

use Auth;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class PersonalRequest extends Request{

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
            'account_type.required' => Lang::get('setting.personal.account_type.required'),
            'account_type.in' => Lang::get('setting.personal.account_type.in'),
            'pesel.required_if' => Lang::get('setting.personal.pesel.required_if'),
            'pesel.digits' => Lang::get('setting.personal.pesel.digits'),
            'nip.required_if' => Lang::get('setting.personal.nip.required_if'),
            'nip.digits' => Lang::get('setting.personal.nip.digits'),
            'company_name.required_if' => Lang::get('setting.personal.company_name.required_if'),
            'company_name.regex' => Lang::get('setting.personal.company_name.regex'),
            'company_name.max' => Lang::get('setting.personal.company_name.max'),
            'first_name.required' => Lang::get('setting.personal.first_name.required'),
            'first_name.regex' => Lang::get('setting.personal.first_name.regex'),
            'first_name.max' => Lang::get('setting.personal.first_name.max'),
            'last_name.required' => Lang::get('setting.personal.last_name.required'),
            'last_name.regex' => Lang::get('setting.personal.last_name.regex'),
            'last_name.max' => Lang::get('setting.personal.last_name.max'),
            'address.required' => Lang::get('setting.personal.address.required'),
            'address.regex' => Lang::get('setting.personal.address.regex'),
            'address.max' => Lang::get('setting.personal.address.max'),
            'city.required' => Lang::get('setting.personal.city.required'),
            'city.regex' => Lang::get('setting.personal.city.regex'),
            'city.max' => Lang::get('setting.personal.city.max'),
            'zip_code.required' => Lang::get('setting.personal.zip_code.required'),
            'zip_code.regex' => Lang::get('setting.personal.zip_code.regex'),
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
            'account_type' => 'required|in:private,company',
            'pesel' => 'required_if:account_type,private,company|digits:11',
            'company_name' => 'required_if:account_type,company|max:64|regex:/^[\pL\pN\s.-]+$/u',
            'nip' => 'required_if:account_type,company|digits:10',
            'first_name' => 'required|max:32|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|max:32|regex:/^[\pL\s-]+$/u',
            'address' => 'required|max:64|regex:/^[\pL\pN\s.\/]+$/u',
            'city' => 'required|max:64|regex:/^[\pL\s-]+$/u',
            'zip_code' => 'required|regex:/^[0-9]{2}-?[0-9]{3}$/Du',
        ];

    }
}
