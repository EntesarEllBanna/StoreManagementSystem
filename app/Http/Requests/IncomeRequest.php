<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomeRequest extends FormRequest
{
    public function authorize()
    {
        return true;//مسموح لاي واحد مش شرط يكون عامل دخول
    }
    public function rules()
    {
        return [
            'store_id' => 'required',
            'transaction_date' => 'required',
            'item_ids' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'store_id.required'  => 'يجب اختيار المخزن',
            'transaction_date.required'  => 'يجب ادخال تاريخ التوريد',
            'item_ids.required'  => 'يجب اختيار صنف واحد على الاقل',
        ];
    }
}
