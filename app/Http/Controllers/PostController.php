<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{

	public function all_post()
	{
	  $posts=Post::latest()->approved()->published()->paginate(6);
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

  $randomposts= Post::approved()->published()->take(3)->inRandomOrder()->get();

    	return view('single_post',compact('post','randomposts'));
    }



   public function postByCategory($slug)
   {
       $category =Category::where('slug',$slug)->first();
       $posts = $category->posts()->approved()->published()->get();
       return view('category',compact('category','posts'));

   }

  public function postBytags($slug)
  {
       $tags =Tag::where('slug',$slug)->first();
       $posts = $tags->posts()->approved()->published()->get();
       return view('tags',compact('tags','posts'));
  }


}
