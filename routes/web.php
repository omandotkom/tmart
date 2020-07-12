<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/user/logout',function(){
    Auth::logout();
    return redirect()->route('home');
})->name('userlogout')->middleware('auth');
Route::get('/', 'IndexController@show')->name('index');
Route::get('/cart/add/{product_id?}/{quantity?}','CartController@store')->name('addtocart')->middleware('auth');
Route::get('/cart','CartController@show')->name('showcart')->middleware('auth');
Route::get('/cart/delete/{cart_id}','CartController@delete')->name('removeitem')->middleware('auth');
Auth::routes();

Route::get('/home', 'IndexController@show')->name('home');

Route::get('/checkout','CheckoutController@show')->name('checkout')->middleware('auth');
Route::post('/payments','PaymentController@show')->name('payment')->middleware('auth');;
Route::post('/order/store','OrderController@store')->name('order')->middleware('auth');;
Route::get('/order','OrderController@show')->name('orderlist')->middleware('auth');;
Route::post('/order/update/{id}/{status}','OrderController@update')->name('updateorderstatus')->middleware('auth');;

Route::get('/product','ProductController@show')->name('addproduct')->middleware('auth');;
Route::post('/product/save/{edit}','ProductController@store')->name("saveproduct")->middleware('auth','admin');;
Route::get('/product/detil/{id}','ProductController@update')->name('updateproduct')->middleware('auth');;
Route::get('/product/remove/{id}','ProductController@remove')->name('removeproduct')->middleware('auth');;

Route::post('product/comment','CommentController@store')->name('comment')->middleware('auth');
Route::get('/users','UserController@show')->name('viewusers')->middleware('auth','admin');
Route::get('/products/category/{category}','ProductController@showbycategory')->name('showbycategory');

Route::get('v',function(){
    $logo = '/images/logotoko.jpg';
    return view('layouts.invoice',['siteimg'=>$logo]);
});
Route::post('/invoice','InvoiceController@invoicebeforepayment')->name('generateinvoice');
Route::get('/invoice/{order_id?}','InvoiceController@invoiceafterpayment')->name("generateinvoiceafterpayment");

Route::get('/admin',function(){
    return view('auth.registeradmin');
});
Route::post('/admin/save','AdminController@create')->name('saveadmin');