<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreItemBalance extends MyModel
{
    //
    protected $table="store_item_balance";
    public function Store(){
        return $this->belongsTo("App\Store");
    }
    public function Item(){
        return $this->belongsTo("App\Item");
    }
    public function Unit(){
        return $this->belongsTo("App\Unit");
    }
}
