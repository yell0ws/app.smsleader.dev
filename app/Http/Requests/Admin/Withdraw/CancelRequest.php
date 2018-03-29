<?php

namespace App\Http\Requests\Admin\Withdraw;

use Auth;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class CancelRequest extends Request
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
            'cancel_reason' => 'required|max:100|regex:/^[\pL\pN\s.!?,]+$/u',
        ];
    }
}
