<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
     public function store(Request $request,$post)
    {
        $this->validate($request,[
            'comment' => 'required'
        ]);
      // return $request;
        $comment          = new Comment();
        $comment->post_id = $post;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();
        Toastr::success('Comment Successfully Published :)','Success');
        return redirect()->back();
    }
}
