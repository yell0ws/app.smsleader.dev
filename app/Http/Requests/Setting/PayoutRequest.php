<?php

namespace App\Http\Requests\Setting;

use Auth;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class PayoutRequest extends Request{

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
        
        return [];

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
            'bank_name' => 'required_with:bank_account|max:64|regex:/^[\pL\s.-]+$/u',
            'bank_account' => 'required_with:bank_name|min:32|max:32|regex:/^[\pN\s]+$/u',
            'paypal' => 'email',
        ];

    }
}
