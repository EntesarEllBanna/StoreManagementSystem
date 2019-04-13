<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Item;
use App\Store;
use App\StoreItemBalance;
use App\Transaction;
use App\TransactionDetails;
use App\TransactionType;
use Session;
use App\Http\Requests\IncomeRequest;
use Maatwebsite\Excel\Facades\Excel;
//عشان عيون الاينبوت تاع البحث
use Illuminate\Support\Facades\Input;

class TransactionController extends BaseController
{
    
    public function transaction_details($id)
    {    
        $items=TransactionDetails::where("transaction_id",$id)->get();
        return view("transaction.transaction_details",compact("items"));
    }  
    public function export()
    {    
        Excel::create('transactions', function($excel) {

            // Set the title
            $excel->setTitle('Our new awesome title');

            // Chain the setters
            $excel->setCreator('Maatwebsite')
                  ->setCompany('Maatwebsite');

            // Call them separately
            $excel->setDescription('A demonstration to change the file properties');
            
            $excel->sheet('Sheetname', function($sheet) {

                $items = DB::table("transaction")
                ->join("admin","admin.id","=","transaction.created_by")
                ->join("store","store.id","=","transaction.store_id")
                ->join("transaction_type","transaction_type.id","=","transaction.transaction_type_id")
                ->select("transaction.id","admin.fullname","store.name as store","transaction_type.name as transaction_type")->get();
                 $sheetArray = []; 

                // Define the Excel spreadsheet headers
                $sheetArray[] = ['id', 'admin','store','transaction_type'];

                // Convert each member of the returned collection into an array,
                // and append it to the payments array.
                foreach ($items as $i) {
                    $sheetArray[] = [$i->id,$i->fullname,$i->store,$i->transaction_type];
                }
                $sheet->fromArray( $sheetArray );

            });

        })->download("pdf");
    }
    public function archive()
    {    
        $stores=Store::all();
        $types=TransactionType::all();
        return view("transaction.archive",compact("stores","types"));
    }  
    
	public function ArchiveDT(Request $request)
    {
		$order_by_index=$request->input("order")[0]["column"];
		$order_by_direction=$request->input("order")[0]["dir"];		
		$columns=array("store.name","transaction_type.name","transaction_date","admin.fullname");
        
        
        $store_id=$request->input("store_id");
        $type_id=$request->input("type_id");     
        $from=$request->input("from");     
        $to=$request->input("to");     
		
        $items = DB::table("transaction")
            ->join("admin","admin.id","=","transaction.created_by")
            ->join("store","store.id","=","transaction.store_id")
            ->join("transaction_type","transaction_type.id","=","transaction.transaction_type_id");
       
        if($store_id!='' && $store_id!=NULL)
            $items = $items->where("store_id",$store_id);
        
         if($type_id!='' && $type_id!=NULL)
            $items = $items->where("transaction_type_id",$type_id); 
        
         if($from!='' && $from!=NULL)
            $items = $items->where("transaction_date",">=",$from); 
        
         if($to!='' && $to!=NULL)
            $items = $items->where("transaction_date","<=",$to); 
        
        
        
		$Length=$request->input("length");
		$Start=$request->input("start");
		$Draw=$request->input("Draw");
		$totalCount = $items->count();
		
       $items=$items->orderby($columns[$order_by_index],$order_by_direction)->take($Length)->skip($Start)
		->select("store.name as store","transaction_type.name as transaction_type","transaction.id"
                 ,"transaction_date","admin.fullname as created_by_name")->get();
        

        
        
		return response()
            ->json(['draw' => $Draw,"recordsTotal"=>$totalCount,
			"recordsFiltered"=>$totalCount,
			"data"=>$items]);
    }
    public function inventory()
    {    
        $stores=Store::all();
        return view("transaction.inventory",compact("stores"));
    }  
        
    public function storeinventory(IncomeRequest $request)
    {
        $item_ids = $request["item_ids"];
        $unit_ids = $request["unit_ids"];
        $quantity_ids = $request["quantity_ids"];
        
        $store_id=$request["store_id"];
        $transaction_date=$request["transaction_date"];
        
        foreach($quantity_ids as $q)
            if($q<0){
                return response()
                    ->json(['status' => 0,"msg"=>"يجب ان تكون الكميات جميعها أكبر من او تساوي صفر"]);
            }
        
        $transaction = new Transaction();
        $transaction->DoTransaction($store_id,$transaction_date,$item_ids,$quantity_ids,$unit_ids,1,5);
        Session::flash("msg","s:تمت عملية الجرد بنجاح");
        return response()
                    ->json(['status' => 1,"msg"=>"تمت عملية الجرد بنجاح","redirect"=>"/transaction/inventory"]);
    }  
    
    public function inventory_items($id)
    {    
        $store_items=StoreItemBalance::join("item","item.id","=","store_item_balance.item_id")->where("store_id",$id)->orderby("item.name")->get();
        $new_items=Item::whereRaw("id not in (select item_id from store_item_balance where store_id=?)",[$id])->get();
        return view("transaction._inventoryitems",compact("store_items","new_items"));
    }  
    
    public function income()
    {    
        $stores=Store::all();
        $items=Item::all();
        return view("transaction.income",compact("stores","items"));
    }    
    public function storeincome(IncomeRequest $request)
    {
        $item_ids = $request["item_ids"];
        $unit_ids = $request["unit_ids"];
        $quantity_ids = $request["quantity_ids"];
        
        $store_id=$request["store_id"];
        $transaction_date=$request["transaction_date"];
        
        foreach($quantity_ids as $q)
            if($q<=0){
                return response()
                    ->json(['status' => 0,"msg"=>"يجب ان تكون الكميات جميعها أكبر من صفر"]);
            }
        
        $transaction = new Transaction();
        $transaction->DoTransaction($store_id,$transaction_date,$item_ids,$quantity_ids,$unit_ids,1,1);
        return response()
                    ->json(['status' => 1,"msg"=>"تمت عملية الاضافة بنجاح"]);
    }  
    
    
    
    public function outcome()
    {    
        $stores=Store::all();
        $items=Item::all();
        return view("transaction.outcome",compact("stores","items"));
    }    
    public function storeoutcome(IncomeRequest $request)
    {
        $item_ids = $request["item_ids"];
        $unit_ids = $request["unit_ids"];
        $quantity_ids = $request["quantity_ids"];
        
        $store_id=$request["store_id"];
        $transaction_date=$request["transaction_date"];
        
        $transaction = new Transaction();
        
        $i=0;
        foreach($quantity_ids as $q){
            if($q<=0){
                return response()
                    ->json(['status' => 0,"msg"=>"يجب ان تكون الكميات جميعها أكبر من صفر"]);
            }
            else{
                $balance=$transaction->Store_Item_Balance($item_ids[$i],$store_id);
                if($q>$balance)
                    return response()
                    ->json(['status' => 0,"msg"=>"يجب ان تكون الكميات اقل من الرصيد الحالي الموجود في المخزن "]);
            }
            $i++;
        }
        
        $transaction = new Transaction();
        $transaction->DoTransaction($store_id,$transaction_date,$item_ids,$quantity_ids,$unit_ids,0,2);
        return response()
                    ->json(['status' => 1,"msg"=>"تمت عملية الاضافة بنجاح"]);
    }  
    
    
    
    
    public function destroy()
    {    
        $stores=Store::all();
        $items=Item::all();
        return view("transaction.destroy",compact("stores","items"));
    }    
    public function storedestroy(IncomeRequest $request)
    {
        $item_ids = $request["item_ids"];
        $unit_ids = $request["unit_ids"];
        $quantity_ids = $request["quantity_ids"];
        
        $store_id=$request["store_id"];
        $transaction_date=$request["transaction_date"];
        
        $transaction = new Transaction();
        
        $i=0;
        foreach($quantity_ids as $q){
            if($q<=0){
                return response()
                    ->json(['status' => 0,"msg"=>"يجب ان تكون الكميات جميعها أكبر من صفر"]);
            }
            else{
                $balance=$transaction->Store_Item_Balance($item_ids[$i],$store_id);
                if($q>$balance)
                    return response()
                    ->json(['status' => 0,"msg"=>"يجب ان تكون الكميات اقل من الرصيد الحالي الموجود في المخزن "]);
            }
            $i++;
        }
        
        $transaction = new Transaction();
        $transaction->DoTransaction($store_id,$transaction_date,$item_ids,$quantity_ids,$unit_ids,0,4);
        return response()
                    ->json(['status' => 1,"msg"=>"تمت عملية الاضافة بنجاح"]);
    }  
    
    
    
    public function move()
    {    
        $stores=Store::all();
        $items=Item::all();
        return view("transaction.move",compact("stores","items"));
    }    
    public function storemove(IncomeRequest $request)
    {
        $item_ids = $request["item_ids"];
        $unit_ids = $request["unit_ids"];
        $quantity_ids = $request["quantity_ids"];
        
        $store_id=$request["store_id"];
        $to_store_id=$request["to_store_id"];
        $transaction_date=$request["transaction_date"];
        
        $transaction = new Transaction();
        
        $i=0;
        foreach($quantity_ids as $q){
            if($q<=0){
                return response()
                    ->json(['status' => 0,"msg"=>"يجب ان تكون الكميات جميعها أكبر من صفر"]);
            }
            else{
                $balance=$transaction->Store_Item_Balance($item_ids[$i],$store_id);
                if($q>$balance)
                    return response()
                    ->json(['status' => 0,"msg"=>"يجب ان تكون الكميات اقل من الرصيد الحالي الموجود في المخزن "]);
            }
            $i++;
        }
        
        $transaction = new Transaction();
        $transaction->DoTransaction($store_id,$transaction_date,$item_ids,$quantity_ids,$unit_ids,0,3);
        $transaction->DoTransaction($to_store_id,$transaction_date,$item_ids,$quantity_ids,$unit_ids,1,3);
        return response()
                    ->json(['status' => 1,"msg"=>"تمت عملية الاضافة بنجاح"]);
    }  
}