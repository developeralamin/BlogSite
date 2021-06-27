<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthorController extends Controller
{
    public function profile($username)
    {
    	 $author=User::where('user_name',$username)->first();

    	 $posts=$author->posts()->approved()->published()->get();

    	 return view('profile',compact('author','posts'));
    }
}
