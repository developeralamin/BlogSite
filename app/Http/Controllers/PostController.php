<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function index($slug)
    {
    	$post = Post::where('slug',$slug)->first();
    	$randomposts= Post::all()->random(3);
    	return view('single_post',compact('post','randomposts'));
    }
}
