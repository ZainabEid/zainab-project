<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }// end of authorize

   
    public function rules()
    {
        return [
            'ar_name' => 'required',
            'en_name' => 'required',
            'photo' => 'required|image',
        ];

    }// end of rules
}// end of category request
