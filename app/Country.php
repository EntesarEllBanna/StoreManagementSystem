<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //يتطلب التعامل مع الاليكونمت وجود عمودين اثنين بالجدوال 
    //created_at, updated_at
    
    
    //انا ببلغ اللارافيل انه اسم جدولي 
    //country 
    //وليس الافتراضي countries
    protected $table="country";
    
    
    public function Accounts(){
        return $this->hasMany('App\Account', 'country_id');
    }
}
