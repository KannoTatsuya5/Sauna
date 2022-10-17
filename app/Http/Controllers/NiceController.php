<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Nice;
use Illuminate\Support\Facades\Auth;

class NiceController extends Controller
{
    // public function index() {
    //     $posts = Post::with('user')->with('nices')->get();
    //     dump($posts);

    //     return view('nices.nice', compact('posts'));
    // }


    // // いいねをしたときの処理
    // public function nice(Post $post) {
    //     $nice = new Nice();
    //     $nice->post_id = $post->id;
    //     $nice->user_id = Auth::id();
    //     $nice->save();
        
    //     return back();
    // }

    // // いいねがされている投稿のいいねを取り消す処理
    // public function unnice(Post $post) {
    //     $user = Auth::id();
    //     $nice = Nice::where('post_id', $post->id)->where('user_id', $user)->first();
    //     $nice->delete();
        
    //     return back();
    // }
}
