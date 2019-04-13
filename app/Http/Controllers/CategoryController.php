<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;
use App\Unit;
use Session;
use App\Http\Requests\CategoryRequest;

//عشان عيون الاينبوت تاع البحث
use Illuminate\Support\Facades\Input;

class CategoryController extends BaseController
{
    public function index()
    {    
        $units=Unit::all();
        return view("category.index",compact("units"));
    }    
    
	public function AjaxDT(Request $request)
    {
		$order_by_index=$request->input("order")[0]["column"];
		$order_by_direction=$request->input("order")[0]["dir"];		
		$columns=array("category.name","unit.name","category.created_at");
        
        $q=$request->input("q");        
        $unit=$request->input("unit");
        $qs="%".str_replace(" ","%",$q)."%";      
		
        $items = DB::table("category")->whereRaw("(category.name like ?)",[$qs]);
        if($unit!='' && $unit!=NULL)
            $items = $items->where("unit_id",$unit);        
        
		$Length=$request->input("length");
		$Start=$request->input("start");
		$Draw=$request->input("Draw");
		$totalCount = $items->count();
		
        $items=$items->join("unit","unit.id","=","category.unit_id")
		->orderby($columns[$order_by_index],$order_by_direction)->take($Length)->skip($Start)
		->select("category.*","unit.name as unit")->get();
         
		 
		return response()
            ->json(['draw' => $Draw,"recordsTotal"=>$totalCount,
			"recordsFiltered"=>$totalCount,
			"data"=>$items]);
    }
    
    public function create()
    {
        $units=Unit::all();
        return view("category.create",compact("units"));
    }
    public function store(CategoryRequest $request)
    {  
        //شيلنا التوكن من البيانات اللي جايه لانه ما الها اصل بالقاعدة
        unset($request["_token"]);
        //انشأنا اوبجيكت بناء على الريكويست الي جاي
        $item = new Category($request->all());
        
        if($item->IsExists($request)){
            return response()->json(['status' => 0,"msg"=>"التصنيف موجودة مسبقا"]);
		}
        
        $item->created_by=$this->adminId;
        $item->save();
                
        return response()
            ->json(['status' => 1,"msg"=>"تم انشاء التصنيف بنجاح"]);
    }
    public function edit($id)
    {
        $units=Unit::all();
        $item=Category::find($id);        
        if($item==NULL){
            Session::flash("msg","خطأ في الرابط الرجاء التأكد");               
            return redirect("/unit");
        }
        return view("category.edit",compact("item","units"));
    }
    public function update(CategoryRequest $request, $id)
    {    
        $item=Category::find($id);
        
        if($item->IsExistsForUpdate($request,$id)){
            return response()->json(['status' => 0,"msg"=>"التصنيف موجودة مسبقا"]);
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
        $item=Category::find($id);
        $item->delete();        
        return response()->json(['status' => 1,"msg"=>"تمت عملية الحذف بنجاح"]);
        
    }
}
