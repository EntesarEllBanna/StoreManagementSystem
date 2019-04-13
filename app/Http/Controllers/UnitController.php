<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Unit;
use Session;
use App\Http\Requests\UnitRequest;

//عشان عيون الاينبوت تاع البحث
use Illuminate\Support\Facades\Input;

class UnitController extends BaseController
{
    public function index()
    {    
        return view("unit.index");
    }    
    
	public function AjaxDT(Request $request)
    {
		$order_by_index=$request->input("order")[0]["column"];
		$order_by_direction=$request->input("order")[0]["dir"];		
		$columns=array("unit.name","unit.created_at");
        
        $q=$request->input("q");
        $qs="%".str_replace(" ","%",$q)."%";      
		
        $items = DB::table("unit")->whereRaw("(name like ?)",[$qs]);
        
		$Length=$request->input("length");
		$Start=$request->input("start");
		$Draw=$request->input("Draw");
		$totalCount = $items->count();
		
        $items=$items
		->orderby($columns[$order_by_index],$order_by_direction)->take($Length)->skip($Start)
		->select("unit.*")->get();
         
		 
		return response()
            ->json(['draw' => $Draw,"recordsTotal"=>$totalCount,
			"recordsFiltered"=>$totalCount,
			"data"=>$items]);
    }
    
    public function create()
    {
        return view("unit.create");
    }
    public function store(UnitRequest $request)
    {  
        //شيلنا التوكن من البيانات اللي جايه لانه ما الها اصل بالقاعدة
        unset($request["_token"]);
        //انشأنا اوبجيكت بناء على الريكويست الي جاي
        $item = new Unit($request->all());
        
        if($item->IsExists($request)){
            return response()->json(['status' => 0,"msg"=>"الوحدة موجودة مسبقا"]);
		}
        
        $item->created_by=$this->adminId;
        $item->save();
                
        return response()
            ->json(['status' => 1,"msg"=>"تم انشاء الوحدة بنجاح"]);
    }
    public function show($id)
    {
        $item=Unit::find($id);        
        if($item==NULL){
            Session::flash("msg","خطأ في الرابط الرجاء التأكد");            
            return redirect("/unit");
        }
        return view("unit.show",compact("item"));
    }
    public function edit($id)
    {
        $item=Unit::find($id);        
        if($item==NULL){
            Session::flash("msg","خطأ في الرابط الرجاء التأكد");               
            return redirect("/unit");
        }
        return view("unit.edit",compact("item"));
    }
    public function update(UnitRequest $request, $id)
    {    
        $item=Unit::find($id);
        
        if($item->IsExistsForUpdate($request,$id)){
            return response()->json(['status' => 0,"msg"=>"الوحدة موجودة مسبقا"]);
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
        $item=Unit::find($id);
        $item->delete();        
        return response()->json(['status' => 1,"msg"=>"تمت عملية الحذف بنجاح"]);
        
    }
}
