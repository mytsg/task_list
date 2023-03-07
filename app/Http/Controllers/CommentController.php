<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Http_Requests\CommentCheck;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function getComments(Post $post){
        $comments = [];

        foreach($post->comments as $comment){
            array_push($comments, $comment);
        }

        return response()->json([
            'comments' => $comments,
        ], Response::HTTP_OK);
    }

    public function store(Request $request){
        dd($request);

        Comment::create([
            'user_id' => Auth::id(),
            'text' => $request->text,
            'post_id' => $request->post_id,    
        ]);
    }

    public function update(Post $post, Comment $comment, Request $request){
        if(Auth::id() == $post->user_id) {
            $comment->text = $request->text;
            $comment->save();
        }
    }

    public function destroy(Post $post, Comment $comment){
        if (Auth::id() == $post->user_id || Auth::id() == $comment->user_id){
        $comment->delete();
        }
    }
}
