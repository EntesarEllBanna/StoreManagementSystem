<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;
use Session;
use App\Item;
use App\Http\Requests\ItemRequest;

//عشان عيون الاينبوت تاع البحث
use Illuminate\Support\Facades\Input;

class ItemController extends BaseController
{
    public function index()
    {    
        $category=Category::all();
        return view("item.index",compact("category"));
    }    
    
	public function AjaxDT(Request $request)
    {
		$order_by_index=$request->input("order")[0]["column"];
		$order_by_direction=$request->input("order")[0]["dir"];		
		$columns=array("item.name","category.name","item.created_at","item.active");
        
        $q=$request->input("q");        
        $category=$request->input("category");
        $active=$request->input("active");
        $qs="%".str_replace(" ","%",$q)."%";      
		
        $items = DB::table("item")->whereRaw("(item.name like ?)",[$qs]);
        if($category!='' && $category!=NULL)
            $items = $items->where("category_id",$category);
        
         if($active!='' && $active!=NULL)
            $items = $items->where("active",$active); 
        
        
        
		$Length=$request->input("length");
		$Start=$request->input("start");
		$Draw=$request->input("Draw");
		$totalCount = $items->count();
		
       $items=$items->join("category","category.id","=","item.category_id")
		->orderby($columns[$order_by_index],$order_by_direction)->take($Length)->skip($Start)
		->select("item.*","category.name as category")->get();
        

        
        
		return response()
            ->json(['draw' => $Draw,"recordsTotal"=>$totalCount,
			"recordsFiltered"=>$totalCount,
			"data"=>$items]);
    }
    
    public function create()
    {
        $category=Category::all();
        return view("item.create",compact("category"));
    }
    public function store(ItemRequest $request)
    {  
        //شيلنا التوكن من البيانات اللي جايه لانه ما الها اصل بالقاعدة
        unset($request["_token"]);
        //انشأنا اوبجيكت بناء على الريكويست الي جاي
        $item = new Item($request->all());
        
        if($item->IsExists($request)){
            return response()->json(['status' => 0,"msg"=>"الصنف موجود مسبقا"]);
		}
        
        $item->created_by=$this->adminId;
        $item->save();
                
        return response()
            ->json(['status' => 1,"msg"=>"تم انشاء الصنف بنجاح"]);
    }
    public function edit($id)
    {
        $category=Category::all();
        $item=Item::find($id);        
        if($item==NULL){
            Session::flash("msg","خطأ في الرابط الرجاء التأكد");               
            return redirect("/item");
        }
        return view("item.edit",compact("item","category"));
    }
    public function update(ItemRequest $request, $id)
    {    
        $item=Item::find($id);
        
        if($item->IsExistsForUpdate($request,$id)){
            return response()->json(['status' => 0,"msg"=>"الصنف موجود مسبقا"]);
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
        $item=Item::find($id);
        $item->delete();        
        return response()->json(['status' => 1,"msg"=>"تمت عملية الحذف بنجاح"]);
        
    }
    
     public function activate($id)
    {
        $item=Item::find($id);
        $item->active = 1 - $item->active;
        $item->save();
    }
}
