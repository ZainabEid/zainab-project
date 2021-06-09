<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }// end of authorize



    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => [
                'required',
               Rule::unique('admins')->ignore($this->admin),
            ],
            'password' => ['sometimes','required' ,  'min:6' ],
            'roles' => ['array', 'sometimes','required'],
        ];

    }// end of rules

    
} // end of admin request
