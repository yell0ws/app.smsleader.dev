<?php

namespace App\Http\Requests\Support;

use Auth;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class ContactRequest extends Request{

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
            'section.required' => Lang::get('support.contact.section.required'),
            'section.in' => Lang::get('support.contact.section.in'),
            'title.required' => Lang::get('support.contact.title.required'),
            'title.min' => Lang::get('support.contact.title.min'),
            'title.max' => Lang::get('support.contact.title.max'),
            'message.required' => Lang::get('support.contact.message.required'),
            'message.min' => Lang::get('support.contact.message.min'),
            'message.max' => Lang::get('support.contact.message.max'),
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
            'section' => 'required|in:global,technical,finance',
            'title' => 'required|min:5|max:255',
            'messages' => 'required|min:20',
        ];

    }
}
