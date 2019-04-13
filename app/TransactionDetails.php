<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends MyModel
{
    //
    protected $table="transaction_details";
    public function Transaction(){
        return $this->belongsTo("App\Transaction");
    }
    public function Item(){
        return $this->belongsTo("App\Item");
    }
    public function Unit(){
        return $this->belongsTo("App\Unit");
    }
}
