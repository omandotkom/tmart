<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Category;

class ProductController extends Controller
{
    public function show()
    {
        $category = Category::all();
        return view('layouts.index', ['content' => 'addproduct', 'categories' => $category]);
    }
    public function showbycategory($category)
    {
        $product = Product::where('category_id', $category)->simplePaginate(12);
        if (Auth::check()) {
            $cart = Cart::select('id')->where('user_id', Auth::user()->id)->sum('product_quantity');
            return view('layouts.index', ['products' => $product, 'content' => 'products', 'cart' => $cart]);
        }
        return view('layouts.index', ['products' => $product, 'content' => 'products']);
    }
    public function remove($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back();
        //return redirect()->route('index');
    }

    public function store($edit = 'add', Request $request)
    {

        
        if ($edit == "add") {
            $product = new Product;
        } else {
            $product = Product::findOrFail($request->id);
        }
        if ($edit == "add") {
            $request->validate([

                'image' => 'bail|required|max:2048',

            ]);
        }
        if (isset($request->image)) {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/product'), $imageName);
            $product->image = asset('images/product/' . $imageName);
       
        }
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->description = $request->description;
        $product->category_id = $request->category;
       /* if (isset($imageName)) {
            $product->image = asset('images/product/' . $imageName);
        } else {
            $product->image = "https://via.placeholder.com/150";
        };*/
        $product->save();
        return redirect()->route('index');
    }
    public function update($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::where('id', $product->category_id)->first();
        $categories = Category::all();

        return view('layouts.index', ['content' => 'addproduct', 'category' => $category, 'categories' => $categories, 'product' => $product]);
    }
}
