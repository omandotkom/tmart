<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class IndexController extends Controller
{
    public function show(){
        $product =  Product::orderBy('updated_at','desc')->simplePaginate(12);
        if (Auth::check()){
            $cart = Cart::select('id')->where('user_id',Auth::user()->id)->sum('product_quantity');
            return view('layouts.index',['products'=>$product,'content'=>'products','cart' => $cart]);
   
        }
        return view('layouts.index',['products'=>$product,'content'=>'products']);
   
    }
}
