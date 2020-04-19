<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function show(){
        $users = User::where('role','buyer')->orderBy('created_at','desc')->get();
        return view('layouts.index',['content' => 'viewusers','users' => $users]);
    }
}
