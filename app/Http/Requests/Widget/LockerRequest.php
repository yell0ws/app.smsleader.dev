<?php

namespace App\Http\Requests\Widget;

use Auth;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class LockerRequest extends Request{

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
            'name' => 'required|max:45|regex:/^[\pL\pN\s]+$/u',
            'domain' => 'required|active_url',
            'redirect' => 'url',
            'payment' => 'required|array|max:3|exists:payment_models,id',
            'color_background' => 'regex:/^#[a-fA-F0-9]{3,6}$/i',
            'color_button' => 'regex:/^#[a-fA-F0-9]{3,6}$/i',
            'text_intro' => 'max:45|regex:/^[\pL\pN\s!.?,]+$/u',
            'text_button' => 'max:45|regex:/^[\pL\pN\s!?,.]+$/u',
            'auto_rule' => 'boolean',
        ];

    }
}
