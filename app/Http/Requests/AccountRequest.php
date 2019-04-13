<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//مسموح لاي واحد مش شرط يكون عامل دخول
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:50',
            'fullname' => 'required|max:50',
            'gender' => 'required|max:11',
            'country_id' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'email.required' => 'Email Address is required',
            'fullname.required'  => 'Full Name is required',
        ];
    }
}
