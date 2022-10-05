<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function detail(User $user) {
        $user = User::find($user->id); //idが、リクエストされた$userのidと一致するuserを取得
        $posts = Post::where('user_id', $user->id) //$userによる投稿を取得
            ->orderBy('created_at', 'desc');

        return view('users.user_detail', compact('user'));
    }
}
