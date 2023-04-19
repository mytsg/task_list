<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Helpers\ViewHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        \Log::debug('index request',[$request->deadline]);

        $posts = Post::with('user')
            ->searchPost($request->search,$request->label,$request->deadline)
            ->select('id','title','user_id','label','created_at','updated_at','content','deadline')
            ->orderBy('created_at','desc')
            ->get();

        // dd($posts);

        return Inertia::render('Post/Index',[
            'posts' => $posts,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $loginUser = Auth::user();
        return Inertia::render('Post/Create',[
            'loginUser' => $loginUser,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
            'deadline' => $request->deadline,
            'label' => $request->label    
        ]);

        return to_route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return Inertia::render('Post/Show',[
            'post' => $post,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return Inertia::render('Post/Edit',[
            'post' => $post,
            'loginUser' => Auth::user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->label = $request->label;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->deadline = $request->deadline;
        $post->user_id = $request->user_id;
        $post->save();

        return to_route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('post.index');
    }
}
