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
Route::post('/payments','PaymentController@show')->name('payment');
Route::post('/order/store','OrderController@store')->name('order');
Route::get('/order','OrderController@show')->name('orderlist');
Route::post('/order/update/{id}/{status}','OrderController@update')->name('updateorderstatus');

Route::get('/product','ProductController@show')->name('addproduct');
Route::post('/product/save/{edit}','ProductController@store')->name("saveproduct");
Route::get('/product/edit/{id}','ProductController@update')->name('updateproduct');
Route::get('/product/remove/{id}','ProductController@remove')->name('removeproduct');
