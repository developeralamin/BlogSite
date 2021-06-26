<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class SearchController extends Controller
{
    public function search(Request $request )
    {
       $queryString = $request->input('query');
      $posts=Post::where('title','LIKE',"%$queryString%")->approved()->published()->get();

    return view('search',compact('posts','queryString'));
    	
    }
}
