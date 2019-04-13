<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/unit/{id}/delete","UnitController@destroy");
Route::post("/unit/AjaxDT","UnitController@AjaxDT");
Route::resource('unit', 'UnitController');

Route::get("/category/{id}/delete","CategoryController@destroy");
Route::post("/category/AjaxDT","CategoryController@AjaxDT");
Route::resource('category', 'CategoryController');

Route::get("/item/{id}/delete","ItemController@destroy");
Route::post("/item/AjaxDT","ItemController@AjaxDT");
Route::get("/item/{id}/activate","ItemController@activate");
Route::resource('item', 'ItemController');

Route::get("/store/{id}/delete","StoreController@destroy");
Route::post("/store/AjaxDT","StoreController@AjaxDT");
Route::get("/store/{id}/activate","StoreController@activate");
Route::resource('store', 'StoreController');



Route::get("/transaction/income","TransactionController@income");
Route::post("/transaction/storeincome","TransactionController@storeincome");

Route::get("/transaction/outcome","TransactionController@outcome");
Route::post("/transaction/storeoutcome","TransactionController@storeoutcome");

Route::get("/transaction/move","TransactionController@move");
Route::post("/transaction/storemove","TransactionController@storemove");


Route::get("/transaction/destroy","TransactionController@destroy");
Route::post("/transaction/storedestroy","TransactionController@storedestroy");


Route::get("/transaction/inventory","TransactionController@inventory");
Route::get("/transaction/inventory_items/{id}","TransactionController@inventory_items");
Route::post("/transaction/storeinventory","TransactionController@storeinventory");


Route::post("/transaction/ArchiveDT","TransactionController@ArchiveDT");
Route::get("/transaction/transaction_details/{id}","TransactionController@transaction_details");
Route::get("/transaction/archive","TransactionController@archive");
Route::get("/transaction/export","TransactionController@export");


Route::post("/balance/AjaxDT","BalanceController@AjaxDT");
Route::get("/balance/store","BalanceController@store");

Route::get("/admin/{id}/delete","AdminController@destroy");
Route::get("/admin/createu","AdminController@createu");
Route::post("/admin/AjaxDT","AdminController@AjaxDT");
Route::get("/admin/{id}/activate","AdminController@activate");
Route::get("/admin/{id}/permission","AdminController@permission");
Route::post("/admin/setpermission/{id}","AdminController@setpermission");
Route::resource('admin', 'AdminController');

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home/noaccess', 'HomeController@noaccess');
Route::get('/home', 'HomeController@index');
Route::get('/home/u', 'HomeController@u');
Route::post('/home/doupload', 'HomeController@doupload');
Route::get('/home/logout', 'HomeController@logout');
Route::get('/home/changepassword', 'HomeController@changepassword');
Route::post('/home/changepassword', 'HomeController@postchangepassword');
