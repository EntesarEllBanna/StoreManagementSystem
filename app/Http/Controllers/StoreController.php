<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Store;
use Session;
use App\Http\Requests\StoreRequest;

//عشان عيون الاينبوت تاع البحث
use Illuminate\Support\Facades\Input;

class StoreController extends BaseController
{
    public function index()
    {    
        
        return view("store.index");
    }    
    
	public function AjaxDT(Request $request)
    {
		$order_by_index=$request->input("order")[0]["column"];
		$order_by_direction=$request->input("order")[0]["dir"];		
		$columns=array("store.name","store.active","store.created_at",);
        
        $q=$request->input("q");        
        $active=$request->input("active");
        $qs="%".str_replace(" ","%",$q)."%";      
		
        $items = DB::table("store")->whereRaw("(store.name like ?)",[$qs]);
         if($active!='' && $active!=NULL)
            $items = $items->where("active",$active); 
                   
        
		$Length=$request->input("length");
		$Start=$request->input("start");
		$Draw=$request->input("Draw");
		$totalCount = $items->count();
		
        $items=$items
		->orderby($columns[$order_by_index],$order_by_direction)->take($Length)->skip($Start)
		->select("store.*")->get();
         
		 
		return response()
            ->json(['draw' => $Draw,"recordsTotal"=>$totalCount,
			"recordsFiltered"=>$totalCount,
			"data"=>$items]);
    }
    
    public function create()
    {
        
        return view("store.create");
    }
    public function store(StoreRequest $request)
    {  
        //شيلنا التوكن من البيانات اللي جايه لانه ما الها اصل بالقاعدة
        unset($request["_token"]);
        //انشأنا اوبجيكت بناء على الريكويست الي جاي
        $item = new Store($request->all());
        
        if($item->IsExists($request)){
            return response()->json(['status' => 0,"msg"=>"المخزن موجود مسبقا"]);
		}
        
        $item->created_by=$this->adminId;
        $item->save();
                
        return response()
            ->json(['status' => 1,"msg"=>"تم انشاء المخزن بنجاح"]);
    }
    public function edit($id)
    {
       
        $item=Store::find($id);        
        if($item==NULL){
            Session::flash("msg","خطأ في الرابط الرجاء التأكد");               
            return redirect("/store");
        }
        return view("store.edit",compact("item"));
    }
    public function update(StoreRequest $request, $id)
    {    
        $item=Store::find($id);
        
        if($item->IsExistsForUpdate($request,$id)){
            return response()->json(['status' => 0,"msg"=>"المخزن موجود مسبقا"]);
		}
        
        //شيلنا التوكن من البيانات اللي جايه لانه ما الها اصل بالقاعدة
        unset($request["_token"]);
        unset($request["_method"]);
        $item->SetValues($request->all());		
        $item->updated_by=$this->adminId;
        $item->save();        
        
                
        return response()->json(['status' => 1,"msg"=>"تمت عملية الحفظ بنجاح"/*,"redirect"=>"/unit"*/]);
        
    }
    public function destroy($id)
    {
        $item=Store::find($id);
        $item->delete();        
        return response()->json(['status' => 1,"msg"=>"تمت عملية الحذف بنجاح"]);
        
    }
    
    public function activate($id)
    {
        $item=Store::find($id);
        $item->active = 1 - $item->active;
        $item->save();
    }
}
