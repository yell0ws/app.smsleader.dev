<?php

namespace App\Http\Requests\Program;

use Auth;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class NewRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

     /**
     * Set the validation messages.
     *
     * @return array
     */
    public function messages()
    {
        
        return [
            'type.required' => Lang::get('setting.personal.zip_code.required'),
            'pesel.required_if' => Lang::get('setting.personal.pesel.required_if'),
            'nip.required_if' => Lang::get('setting.personal.nip.required_if'),
            'first_name.required' => Lang::get('setting.personal.first_name.required'),
            'last_name.required' => Lang::get('setting.personal.last_name.required'),
            'address.required' => Lang::get('setting.personal.address.required'),
            'city.required' => Lang::get('setting.personal.city.required'),
            'zip_code.required' => Lang::get('setting.personal.zip_code.required'),
            'zip_code.regex' => Lang::get('setting.personal.zip_code.regex'),
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
            'payments' => 'required|array|max:3|exists:payment_models,id',
        ];
    }
}
