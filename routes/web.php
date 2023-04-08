<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DirectMessageController;
use Illuminate\Http\Request;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::resource('post',PostController::class)
->middleware(['auth','verified']);

Route::get('test',function(){
    return Inertia::render('Test');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('user',UserController::class)
->middleware(['auth','verified']);

Route::get('/post/{post}/get_comments',[CommentController::class, 'getComments'])
->middleware(['auth', 'verified'])->name('getComments');

Route::resource('post.comments',CommentController::class,[
    'only' => ['update', 'destroy'],
])->middleware(['auth', 'verified']);

// Route::get('/getPostForUser',function (Request $request) {
//     return Post::getPostForParticularUser($request->search, $request->label, $request->useId)
//     ->select('id','title','user_id','deadline','label','created_at','updated_at','content')
//     ->get();
// })->middleware(['auth', 'verified']);

Route::post('/post/comments', [CommentController::class, 'storeComments'])
->middleware(['auth', 'verified'])->name('storeComments');

Route::resource('/message',MessageController::class)
->middleware(['auth', 'verified']);

Route::get('/getMessages',[MessageController::class, 'getMessages'])
->middleware(['auth', 'verified'])->name('getMessages');

Route::resource('/directMessage',DirectMessageController::class)
->middleware(['auth','verified']);

Route::get('/getDirectMessage',[DirectMessageController::class,'getDirectMessage'])
->middleware(['auth', 'verified'])->name('getDirectMessage');

require __DIR__.'/auth.php';
