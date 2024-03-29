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
        $postId = $post->id;
        $comments = Comment::with('user')
            ->where('post_id', $postId)
            ->get();

        // \Log::debug('getComments', [$comments]);

        return [
            'comments' => $comments,
        ];
    }

    public function storeComments(Request $request){
        // dd($request);

        Comment::create([
            'user_id' => Auth::id(),
            'text' => $request->text,
            'post_id' => $request->post_id,    
        ]);

        return to_route('post.show',['post' => $request->post_id]);
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
        return to_route('post.show',['post' => $post->id]);
    }
}
