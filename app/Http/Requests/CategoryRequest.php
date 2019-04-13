<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;//مسموح لاي واحد مش شرط يكون عامل دخول
    }
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'unit_id' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'name.required'  => 'يجب ادخال اسم التصنيف',
            'unit_id.required'  => 'يجب اختيار الوحدة',
        ];
    }
}
