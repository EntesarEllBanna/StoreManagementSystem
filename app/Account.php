<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends MyModel
{
    //
    protected $table="account";
    
    public function Country(){
        //على فرض الفورين
        //country_id
        //والاساسي بالدولة
        //id
        return $this->belongsTo("App\Country");
        
        //المتغير التاني اسم الفورين والتالت اسم البريماري
        //return $this->belongsTo("App\Country","country_id","id");
    }
}
