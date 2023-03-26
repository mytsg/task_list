<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/searchPost',function (Request $request) {
    return Post::searchPost($request->search, $request->label, $request->deadline)
        ->select('id','title','user_id','deadline','label','created_at','updated_at','content')
        ->get();
});

Route::middleware('auth:sanctum')->get('/getPostForUser',function (Request $request) {
    return Post::getPostForUser($request->search, $request->label, $request->useId)
        ->select('id','title','user_id','deadline','label','created_at','updated_at','content')
        ->get();
});
