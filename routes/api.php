<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/cart/add/{cartid?}/{quantity?}','CartController@storeapi')->name('addtocartapi');
Route::get('/checkout/province/{province_id?}','CheckoutController@cities')->name('citiesapi');
Route::get('/checkout/city/{user_id?}/{city_id?}','CheckoutController@citiesdetail')->name("citydetailapi");
//Route::get('/checkout/delivery/{user_id}/{city_id?}','CheckoutController@cost');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
