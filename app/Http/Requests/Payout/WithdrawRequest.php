<?php

namespace App\Http\Requests\Payout;

use Auth;
use Setting;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class WithdrawRequest extends Request{

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
            'amount' => 'required|numeric|min:'.Setting::get('withdraw_standard_limit').'|max:'.Auth::user()->balance,
            'priority' => 'required|in:standard,express',
            'form' => 'required|in:bank,paypal',
        ];

    }
}
