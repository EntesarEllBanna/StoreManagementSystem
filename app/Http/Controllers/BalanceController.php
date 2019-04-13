<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Item;
use App\Store;
use App\StoreItemBalance;
use App\Transaction;
use Session;
use App\Http\Requests\IncomeRequest;

//عشان عيون الاينبوت تاع البحث
use Illuminate\Support\Facades\Input;

class BalanceController extends BaseController
{
    public function store()
    {    
        $stores=Store::all();
        $items=Item::all();
        return view("balance.store",compact("stores","items"));
    }  
    
	public function AjaxDT(Request $request)
    {
		$order_by_index=$request->input("order")[0]["column"];
		$order_by_direction=$request->input("order")[0]["dir"];		
		$columns=array("store.name","item.name","store_item_balance.balance");
        
        
        $store_id=$request->input("store_id");
        $item_id=$request->input("item_id");     
		
        $items = DB::table("store_item_balance")
            ->join("item","item.id","=","store_item_balance.item_id")
            ->join("store","store.id","=","store_item_balance.store_id")
            ->join("unit","unit.id","=","store_item_balance.unit_id");
       
        if($store_id!='' && $store_id!=NULL)
            $items = $items->where("store_id",$store_id);
        
         if($item_id!='' && $item_id!=NULL)
            $items = $items->where("item_id",$item_id); 
        
        
        
		$Length=$request->input("length");
		$Start=$request->input("start");
		$Draw=$request->input("Draw");
		$totalCount = $items->count();
		
       $items=$items->orderby($columns[$order_by_index],$order_by_direction)->take($Length)->skip($Start)
		->select("store_item_balance.balance","item.name as item","store.name as store","unit.name as unit")->get();
        

        
        
		return response()
            ->json(['draw' => $Draw,"recordsTotal"=>$totalCount,
			"recordsFiltered"=>$totalCount,
			"data"=>$items]);
    }
}