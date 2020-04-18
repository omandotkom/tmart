<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    public function store(Request $request){
        $request->validate([

            'image' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->name = $request->name;
        $order->province = $request->province;
        $order->city = $request->city;
        $order->address = $request->address;
        $order->courier = $request->courier;
        $order->phone = $request->phone;
        $order->grandtotal = $request->grandtotal;
        $order->status = "PaymentWaitingConfirmation";
        $order->postalcode = $request->postalcode;
        $order->image = $imageName;
        $order->save();

        $cart = Cart::where('user_id',Auth::user()->id)->get();
        foreach($cart as $c){
            $newstock = $c->product->stock - $c->product_quantity;
            $c->product->update([
                'stock' => $newstock,
            ]);
            $orderdetil = new OrderDetail;
            $orderdetil->order_id = $order->id;
            $orderdetil->product_id = $c->product_id;
            $orderdetil->product_quantity = $c->product_quantity;
            $orderdetil->save();
            $c->delete();
        }
        return redirect()->route('orderlist');
        //return $imageName;
    }
    public function show(){
        if (Auth::user()->role == "buyer"){
            $orderlist = Order::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }else{
            $orderlist = Order::orderBy('created_at', 'desc')->simplePaginate(10);
        }
        return view('layouts.index',['orderlist' =>$orderlist,'content' => 'orderlist']);
    }
    public function update($id,$status, Request $request){
        
        $order = Order::findOrFail($id);
        $order->status = $status;
        if (isset($request) && isset($request->trackingid)){
            $order->trackingnumber = $request->trackingid;
        }
        $order->save();
        
        return redirect()->route('orderlist');
    }
}
