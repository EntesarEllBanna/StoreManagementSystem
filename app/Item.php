<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends MyModel
{
    //
    protected $table="item";
    protected $uniqueColumn="name";
    
    public function Category(){
        return $this->belongsTo("App\Category");
    }
}
