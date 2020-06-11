<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{
    public function show(Request $request)
    {
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
        $deliverycost = explode(",", $deliverycost);
        $deliverycost = $deliverycost[2];
        $totalPrice =  $totalPrice + $deliverycost;
        $itemlist = Cart::where('user_id', Auth::user()->id)->get();

        $invoice = \ConsoleTVs\Invoices\Classes\Invoice::make();
        $invoice =  $invoice->with_pagination(true)
            ->duplicate_header(true)
            ->due_date(Carbon::now()->addMonths(1))
            ->notes('Invoice ini dibuat pada '.Carbon::now())
            ->customer([
                'name'      => $request->name,
                'phone'     => $request->phone,
                'location'  => $request->alamat,
                'zip'       => $request->postalcode,
                'city'      => $request->cityname,
                'province'  => $request->provincename,
                'country'   => 'Indonesia',
            ]);
        foreach ($itemlist as $item) {
            $amnt = $item->product_quantity * $item->product->price;
         $invoice->addItem($item->product->name, $item->product->price, $item->product_quantity, $amnt, $item->product->image);
        }
        $invoice->addItem('Delivery',$deliverycost);
        //$filename = str_replace("-","",Carbon::now());
        $filename = Carbon::now();
        $filename = str_replace(":","_",$filename);
        $filename = str_replace(" ","",$filename);

        $invoice->save('public/'.Auth::user()->id.'/'.$filename.'.pdf');
        // ->download('demo');
        $invoice_url= url('/storage/'.Auth::user()->id.'/'.$filename.'.pdf');
        
        return view('layouts.index', ['content' => 'payment', 'request' => $request, 'itemlist' => $itemlist, 'ongkir' => $deliverycost,'invoice' =>$invoice_url ,'total' => $totalPrice]);
    }
}
