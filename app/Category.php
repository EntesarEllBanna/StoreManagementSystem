<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends MyModel
{
    //
    protected $table="category";
    protected $uniqueColumn="name";
    
    public function Unit(){
        return $this->belongsTo("App\Unit");
    }
}
