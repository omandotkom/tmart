<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(){
        return view('layouts.index',['content' => 'addproduct']);
    }
    public function remove($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return back();
        //return redirect()->route('index');
    }
    public function store($edit = 'add',Request $request){
        
        if ($edit == "add"){
        $request->validate([

            'image' => 'bail|required|max:2048',

        ]);}
        if (isset($request->image)){
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images/product'), $imageName);
        }
        if ($edit == "add"){
        $product = new Product;}else{
            $product = Product::findOrFail($request->id);
        }
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->description = $request->description;
        if (isset($imageName)){
        $product->image = asset('images/product/'.$imageName);}else{
            $product->image = "https://via.placeholder.com/150";
        };
        $product->save();
        return redirect()->route('index');
    }
    public function update($id){
        $product = Product::findOrFail($id);
        return view('layouts.index',['content' => 'addproduct','product'=>$product]);
    }
}
