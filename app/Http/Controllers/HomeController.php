<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
include_once("UploadHandler.php");
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout() {
		\Auth::logout();
		return redirect("/login");	
	}
    public function u(){
        return view("upload");
    }
    public function doupload(){
         $file = Input::file('files');

        if($file) {

            $destinationPath = public_path() . '/uploads/';
            $filename = $file->getClientOriginalName();

            $upload_success = Input::file('files')->move($destinationPath, $filename);

            if ($upload_success) {
                return \Response::json('success', 200);
            } else {
                return \Response::json('error', 400);
            }
        }
    }
    public function index()
    {
        return view('home');
    }
    public function noaccess()
    {
        return view('noaccess');
    }
    public function changepassword()
    {
        return view('changepassword');
    }
    
    //post
    public function postChangepassword(Request $request){
		$this->validate($request, [
        'oldpassword' => 'required',
        'password' => 'required|min:4|confirmed',
    	],
                       ["oldpassword.required"=>"الرجاء ادخل كلمة المرور الحالية",
                       "password.required"=>"الرجاء ادخل كلمة المرور الجديدة",
                       "password.min"=>"كلمة المرور الجديدة على الاقل 4 احرف",
                       "password.confirmed"=>"تأكيد كلمة المرور يجب ان يطابق الكلمة الجديدة"]);
		
		//المستخدم اللي عامل دخول
		$user = \Auth::user();
		
		if($this->IsValidOldPassword($request->input("oldpassword")))
		{
			$user->password=bcrypt($request->input("password"));
			$user->save();			
			Session::flash("msg","s:تمت عملية تغيير كلمة المرور بنجاح");
			return redirect("/home/changepassword");
		}
		else
		{			
			Session::flash("msg","e:كلمة المرور الحالية غير صحيحة");
			return redirect("/home/changepassword");
		}
	}
    
    
	function IsValidOldPassword($password)
	{
		$user = \Auth::User();
		
		$credentials2 = ['email' => $user->email, 
			'password' => $password];

		if (\Auth::validate($credentials2)) {
			return 1;
		}
		else
			return 0;
	}
}
