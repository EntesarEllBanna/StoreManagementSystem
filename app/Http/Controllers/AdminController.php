<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\AccountUser;   
use Session;
use App\User;
use App\Http\Requests\AccountUserRequest;
use Illuminate\Support\Facades\Input;


class AdminController extends BaseController
{
     public function index()
    {    
        $units=AccountUser::all();
        return view("admin.index",compact("units"));
    }    
    public function AjaxDT(Request $request)
    {
		$order_by_index=$request->input("order")[0]["column"];
		$order_by_direction=$request->input("order")[0]["dir"];		
		$columns=array("admin.fullname","admin.email","admin.mobile","admin.created_at","admin.active");
        
        $q=$request->input("q");        
        $active=$request->input("active");
        $qs="%".str_replace(" ","%",$q)."%";      
		
        $items = DB::table("admin")->whereRaw("(fullname like ? or email like ? or mobile like ?)",[$qs,$qs,$qs]);
        
         if($active!='' && $active!=NULL)
            $items = $items->where("active",$active); 
    
        
		$Length=$request->input("length");
		$Start=$request->input("start");
		$Draw=$request->input("Draw");
		$totalCount = $items->count();
		
        $items=$items
		->orderby($columns[$order_by_index],$order_by_direction)->take($Length)->skip($Start)
		->select("admin.*")->get();
          
		return response()
            ->json(['draw' => $Draw,"recordsTotal"=>$totalCount,
			"recordsFiltered"=>$totalCount,
			"data"=>$items]);
    }
    public function permission($id)
    {
        return view("admin.permission",compact("id"));        
    }
    public function setpermission($id,Request $request)
    {
        \DB::table("admin_link")->where("admin_id",$id)->delete();
        foreach($request["permission"] as $p){
            \DB::table("admin_link")->insert(["admin_id"=>$id,"link_id"=>$p]);
        }
        return response()
            ->json(['status' => 1,"msg"=>"تم حفظ الصلاحيات بنجاح"]);
    }
    public function create()
    {
        return view("admin.create");
        
    }
    
    public function createu()
    {
        return view("admin.createu");
    } 
    
    public function store(AccountUserRequest $request)
    {         
        unset($request["_token"]);
        $isExists=User::where("email",$request["email"])->count()>0;
        if($isExists){
            return response()->json(['status' => 0,"msg"=>"البريد الالكتروني موجودة مسبقا"]);
		}
        $user = User::create([
            'name' => $request['fullname'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        
        unset($request["password"]);
        //انشأنا اوبجيكت بناء على الريكويست الي جاي
        $item = new AccountUser($request->all());
        $item->created_by=$this->adminId;
        $item->user_id=$user->id;
        $item->save();
                
        return response()
            ->json(['status' => 1,"msg"=>"تم اضافة المستخدم بنجاح"]);
    }
    
    
    
     public function edit($id)
    {
        $item=AccountUser::find($id);        
        if($item==NULL){
            Session::flash("msg","خطأ في الرابط الرجاء التأكد");               
            return redirect("/item");
        }
        return view("admin.edit",compact("item"));
    }
    public function update(AccountUserRequest $request, $id)
    {    
        $item=AccountUser::find($id);
        $newPassword=$request["resetpassword"];
        $user=User::find("$item->user_id");
        $user->name=$request["fullname"];
        if($newPassword!="" && $newPassword!=NULL){
            $user->password=bcrypt($request['resetpassword']);
        }        
        $user->save();    
        unset($request["_token"]);
        unset($request["_method"]);
        unset($request["email"]);
        unset($request["resetpassword"]);
        $item->SetValues($request->all());		
        $item->save();        

        return response()
            ->json(['status' => 1,"msg"=>"تمت عملية الحفظ بنجاح"/*,"redirect"=>"/unit"*/]);
        
    }
    
    public function destroy($id)
    {
        $User=AccountUser::find($id);
        $User->delete();        
        return response()
           ->json(['status' => 1,"msg"=>"تمت عملية الحذف بنجاح"]);
        
    }
   
    public function activate($id)
    {
        $User=AccountUser::find($id);
        $User->active = 1 - $User->active;
        $User->save();
    }
}
