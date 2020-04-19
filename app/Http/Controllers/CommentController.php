<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function store(Request $request){
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $request->productid;
        $comment->comment = $request->comment;
        $comment->save();
        return back();
    }
}
