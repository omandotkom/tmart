<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
class AdminController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = "admin";
        $user->save();
        
        return redirect()->route('login');
    }
}
