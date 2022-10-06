<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    public function detail(User $user) {

        $user = User::find($user->id); //idが、リクエストされた$userのidと一致するuserを取得
        $posts = Post::where('user_id', $user->id)->get(); //$userによる投稿を取得

        return view('users.user_detail', compact('user', 'posts'));
    }
}
