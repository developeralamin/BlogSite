<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Brian2694\Toastr\Facades\Toastr;


class CommentController extends Controller
{
    public function index($value='')
    {
    	$comments = Comment::latest()->get();
    	return view('admin.comments',compact('comments'));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
    	$comment->delete();
        Toastr::success('Comment Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
