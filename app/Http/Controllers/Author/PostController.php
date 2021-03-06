<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Notifications\NewAuthorPost;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $this->data['posts'] = Auth::User()->posts()->latest()->get();
        return view('author.post.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //   if($post->user_id != Auth::id()){
       //  Toastr::error('You are not authorized in this post :)' ,'Error');
       //  return redirect()->back();
       // }
           $categories = Category::all();
        $tags          = Tag::all();
        return view('author.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //   if($post->user_id != Auth::id()){
       //  Toastr::error('You are not authorized in this post :)' ,'Error');
       //  return redirect()->back();
       // }
         $this->validate($request,[
            'title'       => 'required',
            'image'       => 'required|mimes:jpeg,bmp,png,jpg',
            'categories'  => 'required',
            'tags'        => 'required',
            'body'        => 'required',
        ]);
         
        $image=$request->file('image');
        $slug = Str::slug($request->title);
        if (isset($image))
        {
         //make unique name for image
        $currentDate = Carbon::now()->toDateString();
       $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

       //  check category dir is exists

            if (!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }
//   resize image for post and upload

            $postImage = Image::make($image)->resize(1600,1066)->save(90);
            Storage::disk('public')->put('post/'.$imagename,$postImage);
        }
        else{
            $imagename='default.png';
        }

         $post = new Post();
        $post->user_id = Auth::id();
        $post->slug = $slug;
        $post->image = $imagename;
        $post->title = $request->title;
        $post->body = $request->body;

        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        
        $user = User::where('role_id','1')->get();
       Notification::send($user,new NewAuthorPost($post));

        Toastr::success('Post Successfully Saved :)' ,'Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id != Auth::id()){
        Toastr::error('You are not authorized in this post :)' ,'Error');
        return redirect()->back();
       }
      return view('author.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != Auth::id()){
        Toastr::error('You are not authorized in this post :)' ,'Error');
        return redirect()->back();
       }
         $categories  = Category::all();
        $tags         = Tag::all();
        // $post         = Post::findOrFail($id);

        return view('author.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id != Auth::id()){
        Toastr::error('You are not authorized in this post :)' ,'Error');
        return redirect()->back();
       }
          $this->validate($request,[
            'title'       => 'required',
            'image'       => 'image',
            'categories'  => 'required',
            'tags'        => 'required',
            'body'        => 'required',
        ]);
         
        $image=$request->file('image');
        $slug = Str::slug($request->title);
        if (isset($image))
        {
         //make unique name for image
        $currentDate = Carbon::now()->toDateString();
       $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

       //  check category dir is exists

            if (!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            //delete old image
             if (Storage::disk('public')->exists('post/'.$post->image))
            {
                Storage::disk('public')->delete('post/'.$post->image);
            }

//   resize image for post and upload

            $postImage = Image::make($image)->resize(1600,1066)->save(90);
            Storage::disk('public')->put('post/'.$imagename,$postImage);
        }
        else{
            $imagename=$post->image;
        }

        $post->user_id = Auth::id();
        $post->slug = $slug;
        $post->image = $imagename;
        $post->title = $request->title;
        $post->body = $request->body;

        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        Toastr::success('Post Successfully Saved :)' ,'Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
       // $post = Post::find($post);
if($post->user_id != Auth::id()){
        Toastr::error('You are not authorized in this post :)' ,'Errors');
        return redirect()->back();
       }
    if(Storage::disk('public')->exists('post/'.$post->image))
          {
            Storage::disk('public')->delete('post/'.$post->image);
            
          }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('Post Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
