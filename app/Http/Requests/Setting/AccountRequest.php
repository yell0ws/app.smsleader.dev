<?php

namespace App\Http\Requests\Setting;

use Auth;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class AccountRequest extends Request{

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
            'gg_number.min' => Lang::get('setting.account.gg_number.min'),
            'gg_number.max' => Lang::get('setting.account.gg_number.max'),
            'gg_number.regex' => Lang::get('setting.account.gg_number.regex'),
            'chat_view.required' => Lang::get('setting.account.chat_view.required'),
            'chat_view.in' => Lang::get('setting.account.chat_view.in'),
            'rank_view.required' => Lang::get('setting.account.rank_view.required'),
            'rank_view.in' => Lang::get('setting.account.rank_view.in'),
            'lead_sound.required' => Lang::get('setting.account.lead_sound.required'),
            'lead_sound.numeric' => Lang::get('setting.account.lead_sound.numeric'),
            'lead_sound.min' => Lang::get('setting.account.lead_sound.min'),
            'lead_sound.max' => Lang::get('setting.account.lead_sound.max'),
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
            'gg_number' => 'min:3|max:15|regex:/^[\pN]+$/u',
            'chat_view' => 'required|in:show,hide',
            'rank_view' => 'required|in:show,hide,anonym',
            'lead_sound' => 'required|numeric|min:0|max:9',
        ];

    }
}
