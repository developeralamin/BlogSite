<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{

	public function all_post()
	{
		$posts=Post::latest()->paginate(6);
		return view('posts',compact('posts'));
	}

    public function index($slug)
    {
    	$post = Post::where('slug',$slug)->first();

    	$blogkey = 'blog_'.$post->id;
    	if(!Session::has($blogkey)){
    		$post->increment('view_count');
    		Session::put($blogkey,1);
    	}

    	$randomposts= Post::all()->random(3);

    	return view('single_post',compact('post','randomposts'));
    }
}
