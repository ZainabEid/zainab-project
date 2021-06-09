<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UserRequest extends FormRequest
{

   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,except,' . $this->user,
            'password' => ['sometimes', 'required',  'min:6'],
            'phones' => ['required', 'array', 'min:1'],
            'phones.*' => ['min:11', 'max:13'],
            'photo' => ['image'],
        ];
    } // end of rules

 

}
