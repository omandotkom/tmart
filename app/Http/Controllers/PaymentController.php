<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show(Request $request){
        /*request()->validate([
            'provincename' => 'bail|required',
            'name' => 'required',
            'cityname' => 'required',
            'alamat' => 'required',
            'postalcode' => 'required',
            'courier'=> 'required',
            'phone' => 'request',
        ]);*/
        $totalPrice = 0;
       
        $deliverycost = $request->courier;
        $deliverycost = explode(",",$deliverycost);
        $deliverycost = $deliverycost[2];
        $totalPrice =  $totalPrice + $deliverycost;
        $itemlist = Cart::where('user_id',Auth::user()->id)->get();
        
        return view('layouts.index',['content' => 'payment','request' => $request,'itemlist'=>$itemlist,'ongkir'=>$deliverycost,'total' => $totalPrice]);
    }
}
