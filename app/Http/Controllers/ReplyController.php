<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Post $post)
    {
        $request->validate([
            'reply_message' => 'required | min:1 | max:1500',
        ]);

        $reply = new Reply();
        $reply->user_id = Auth::id();
        $reply->post_id = $post->id;
        $reply->message = $request->input('reply_message');
        $reply->save();
    

        return redirect()->route('post.show', compact('post', 'reply'));
    }
}
