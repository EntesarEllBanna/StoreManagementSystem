<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends MyModel
{
    //
    protected $table="transaction";
    public function TransactionType(){
        return $this->belongsTo("App\TransactionType");
    }
    public function Store_Item_Balance($item_id,$store_id){
        $store_balance=\DB::table("store_item_balance")->where("store_id",$store_id)->where("item_id",$item_id)->first();
        $current_balance=0;
        if($store_balance!=NULL)
            $current_balance=$store_balance->balance;
        return $current_balance;
    }
    public function DoTransaction($store_id,$transaction_date,$item_ids,$q_ids,$u_ids,$is_input,$transaction_type_id){
        $transaction = new Transaction();
        $transaction->store_id=$store_id;
        $transaction->created_by=1;
        $transaction->is_input=$is_input;
        $transaction->transaction_date=$transaction_date;
        $transaction->transaction_type_id=$transaction_type_id;
        
        $transaction->save();
        
        
        for($i=0;$i<sizeof($item_ids);$i++){                
            $item_id = $item_ids[$i];
            $q = $q_ids[$i];
            $u = $u_ids[$i];
            
            $current_balance=$this->Store_Item_Balance($item_id,$store_id);
            
            $transactionDetails = new TransactionDetails();
            $transactionDetails->transaction_id=$transaction->id;
            $transactionDetails->item_id=$item_id;
            $transactionDetails->unit_id=$u;
            $transactionDetails->balance=$current_balance;
            $transactionDetails->quantity=$q;
            
            $transactionDetails->save();
        }
    }
}
