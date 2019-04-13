<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\CheckPermission;
use DB;
use Session;

//عشان عيون الاينبوت تاع البحث
use Illuminate\Support\Facades\Input;

class BaseController extends Controller
{
    protected $adminId=1;
    function __construct() {
       // $this->middleware('auth');     
        //$this->middleware('CheckPermission');
        //\View::share("AdminId",$this->adminId);
    }
}