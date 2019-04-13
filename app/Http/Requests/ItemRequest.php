<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;//مسموح لاي واحد مش شرط يكون عامل دخول
    }
    
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'category_id' => 'required',
          //  'active' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'يجب ادخال اسم الصنف',
            'category_id.required'  => 'يجب تحديد التصنيف',
          //  'active.required'  => 'يجب تحديد الحالة',
        ];
    }
    
    
}

