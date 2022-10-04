<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
// 投稿画面に遷移
Route::get('/post', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create');
// 投稿した後の画面遷移
Route::post('/', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');
// 編集画面に遷移
Route::get('/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
// 編集した後の画面遷移
Route::put('/', [\App\Http\Controllers\PostController::class, 'update'])->name('post.update');

// Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');