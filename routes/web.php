<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

// 一覧表示
Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');
//詳細(コメント)画面表示
Route::get('/posts/show/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('post.show')->middleware('auth');
//コメントをした後の画面遷移
Route::post('/posts/show/{post}', [\App\Http\Controllers\ReplyController::class, 'store'])->name('reply.store')->middleware('auth');
// 投稿画面に遷移
Route::get('/posts/create', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create')->middleware('auth');
// 投稿した後の画面遷移
Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store')->middleware('auth');
// 編集画面に遷移
Route::get('/posts/edit/{post}', [\App\Http\Controllers\PostController::class, 'edit'])->name('post.edit')->middleware('auth');
// 編集した後の画面遷移
Route::patch('/posts/{post}', [\App\Http\Controllers\PostController::class, 'update'])->name('post.update')->middleware('auth');
//削除した後の画面遷移
Route::delete('/posts/{post}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy')->middleware('auth');
//ユーザーの詳細
Route::get('/user/detail/{user}', [\App\Http\Controllers\UserController::class, 'detail'])->name('user.detail');
//いいねしたときの処理
Route::post('posts/favorites/{post}', [\App\Http\Controllers\FavoriteController::class, 'store'])->name('favorites')->middleware('auth');
Route::post('posts/{post}/unfavorites', [\App\Http\Controllers\FavoriteController::class, 'destroy'])->name('unfavorites')->middleware('auth');
