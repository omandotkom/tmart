<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function storeapi($cart_id, $quantity){
        $cart = Cart::where('id', $cart_id)->first();
        if ($quantity == null || $quantity < 1){
            return Response("Failed",403);
        }
        
    
        if ($cart != null) {    
            if($cart->product->stock < $quantity){
                return Response(Failed,403);
            };
            $cart->product_quantity   = $quantity;
            $cart->save();
            return Response("success",200);
            
        }
        return Response("Failed",403);
      
    }
    public function store($product_id,$quantity)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->first();
        if ($cart == null) {
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $product_id;
            $cart->product_quantity = 1;
        } else {
            $cart->product_quantity   = $cart->product_quantity + $quantity;
         }
        $cart->save();
        return redirect()->back()->with('success', 'Berhasil menambahkan barang ke keranjang.');
    }
    public function show()
    {
        $cart = Cart::select('id')->where('user_id',Auth::user()->id)->sum('product_quantity');
        $itemlist = Cart::where('user_id', Auth::user()->id)->get();
         if ($cart == 0) {
            return redirect()->route('index');
        }
        return view('layouts.index', ['cart' => $cart, 'itemlist' => $itemlist, 'content' => 'cart']);
    }
    public function delete($cart_id){
        $cart = Cart::findOrFail($cart_id);
        $cart->delete();
        return back();
    }
 
}
