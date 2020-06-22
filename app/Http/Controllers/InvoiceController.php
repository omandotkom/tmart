<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\OrderDetail;
use App\OrderShipments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function invoicebeforepayment(Request $request){
     $items = Cart::where('user_id',Auth::user()->id)->get();
     return view('layouts.invoice',['items'=>$items,'request'=>$request]);
    }
    public function invoiceafterpayment($order_id){
        $items = OrderDetail::where('order_id',$order_id)->get();
        $request = Order::find($order_id);
        $shipment = OrderShipments::where('order_id',$order_id)->first();
        return view('layouts.invoice',['items'=>$items,'request'=>$request,'shipment'=>$shipment]);
       
       
    }
}

