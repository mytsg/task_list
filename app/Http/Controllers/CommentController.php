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
        $users = [];

        foreach($post->comments as $comment){
            array_push($comments, $comment);
        }

        foreach($post->comments as $comment){
            if(!in_array($comment->user,$users)){
                array_push($users, $comment->user);
            }
        }

        return [
            'comments' => $comments,
            'users' => $users,
        ];

        // return response()->json([
        //     'comments' => $comments,
        // ], Response::HTTP_OK);
    }

    public function storeComments(Request $request){
        // dd($request);

        Comment::create([
            'user_id' => Auth::id(),
            'text' => $request->text,
            'post_id' => $request->post_id,    
        ]);

        return redirect()->route('post.show',['post' => $request->post_id]);
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
