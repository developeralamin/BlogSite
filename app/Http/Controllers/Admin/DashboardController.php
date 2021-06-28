<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;


class DashboardController extends Controller
{
	public function index()
	{
		 $posts = Post::all();

		 $popular_posts=Post::withCount('comments')
		 				->withCount('favorite_to_users')
		 				->orderBy('view_count','desc')
		 				->orderBy('comments_count','desc')
		 				->orderBy('favorite_to_users_count','desc')
		 				->take(5)
		 				->get();

		 $pending_post=Post::where('is_approved',false)->count();
		 $total_view=Post::sum('view_count');
		 $aurhors_count=User::where('role_id',2)->count();

		 $new_author_today=User::where('role_id',2)
		 					->whereDate('created_at',Carbon::today())->count();

		 $active_authors=User::where('role_id',2)
		 					  ->withCount('posts')					
		 					  ->withCount('comments')					
		 					  ->withCount('favorite_posts')	
		 					  ->orderBy('posts_count','desc')
		 					  ->orderBy('comments_count','desc')
		 					  ->orderBy('favorite_posts_count','desc')
		 					  ->get();

      $category_COUNT = Category::all()->count();
      $tag_COUNT     = Tag::all()->count();

		return view('admin.dashboard',compact('posts','popular_posts','pending_post','total_view','aurhors_count','new_author_today','active_authors','category_COUNT','tag_COUNT'));
	}
    
}
