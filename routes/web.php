<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
  //1St parameter:uri=>sub of url , 2nd parameter:action=>function that will be executed when go to the path /
  //closure function or callback function
    return view('welcome');//execute welcome.blade.php file
    //view:global helper method=>make load for welcome.blade.php view , takes just name of view
  // return 'monica'; 
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware(['auth','second-gate']);
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class,'store'])->name('posts.store')->middleware('auth');
Route::get('/posts/{post}', [PostController::class,'show'])->name('posts.show')->middleware('auth');
Route::get('/posts/{post}/edit', [PostController::class,'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class,'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class,'destroy'])->name('posts.destroy');
Route::get('list', [PostController::class,'page']);
Route::post('/posts/comment/{postId}',[PostController::class,'addComment'])->name('create.comment');




Auth::routes();


use Laravel\Socialite\Facades\Socialite;
 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github.auth');
 
Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
 dd($user);
    // $user->token
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
