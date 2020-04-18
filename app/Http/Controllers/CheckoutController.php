<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 6ec8e0694b95ab3f43baefb36a33c7e5"
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return route('home');
        }
        $data = json_decode($response, true);
        $data = $data['rajaongkir'];
        $dataprovince = $data['results'];


        $cartitems = Cart::where('user_id', Auth::user()->id)->get();
        $cart = Cart::select('id')->where('user_id', Auth::user()->id)->sum('product_quantity');
        return view('layouts.index', ['cart' => $cart, 'provinces' => $dataprovince, 'itemlist' => $cartitems, 'content' => 'checkout']);
    }
    public function cities($province_id)
    {
        $curl = curl_init();
        $url =  'https://api.rajaongkir.com/starter/city' . "?province=" . $province_id;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 6ec8e0694b95ab3f43baefb36a33c7e5"
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return route('home');
        }
        $data = json_decode($response, true);
        $data = $data['rajaongkir'];
        $datacities = $data['results'];
        return Response($datacities);
    }
    public function cxitiesdetail($city_id)
    {
        $curl = curl_init();
        $url =  'https://api.rajaongkir.com/starter/city?id=' . $city_id;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 6ec8e0694b95ab3f43baefb36a33c7e5"
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return route('home');
        }
        $data = json_decode($response, true);
        $data = $data['rajaongkir'];
        $datacities = $data['results'];
        return Response($datacities);
    }
    public function citiesdetail($user_id, $city_id)
    {
        $weight = DB::table('carts')->join('products', 'carts.product_id', 'products.id')->where('carts.user_id', $user_id)->sum('products.weight');


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=41&destination=" . $city_id . "&weight=" . $weight . "&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 6ec8e0694b95ab3f43baefb36a33c7e5"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            $data = $data["rajaongkir"];
            $cost = $data["results"];
            
            $cost =  $cost[0]["costs"];
            return response()->json(['data' => $data,'costs'=>$cost]);
        }

    }
    
}
