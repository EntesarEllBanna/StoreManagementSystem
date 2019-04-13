<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountUserRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            
            'fullname' => 'required|max:50',
            'email' => 'required|email|max:50',
            'mobile' => 'required|max:10',
            'active' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'fullname.required'  => 'الرجاء ادخال الاسم كامل ',
            'email.required' => 'الرجاء ادخال الايميل',
            'mobile.required' => 'الرجاء ادخال رقم الجوال ',
            'active.required' => 'الرجاء ادخال حالة المستخدم',

        ];
    }
}
