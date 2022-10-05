<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * 投稿された情報の一覧表示.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 新しい順で一覧表示
        $posts = Post::latest()->get();
        //変数$postsをposts/index.blade.phpに渡す
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $file = $request->file('image_path');
        if(!empty($file)) {
            $filename = $file->getClientOriginalName();
            $file->move('./upload/', $filename);
        } else {
            $filename = "";
        }

        $request->validate([
            'nickname' => 'required | min:1 | max: 255',
            'sauna_name' => 'required | min:1 | max:255',
            'content' => 'required | min:1 | max: 355',
        ]);

        $post = new Post();
        $post->nickname = $request->input('nickname');
        $post->sauna_name = $request->input('sauna_name');
        $post->image_path = $filename;
        $post->content = $request->input('content');
        $post->save();
        return redirect()->route('post.store')->with('message', '投稿が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $file = $request->file('image_path');
        if(!empty($file)) {
            $filename = $file->getClientOriginalName();
            $file->move('./upload/', $filename);
        } else {
            $filename = "";
        }

        $request->validate([
            'nickname' => 'required | min:1 | max: 255',
            'sauna_name' => 'required | min:1 | max:255',
            'content' => 'required | min:1 | max: 355',
        ]);

        $post->nickname = $request->input('nickname');
        $post->sauna_name = $request->input('sauna_name');
        $post->image_path = $filename;
        $post->content = $request->input('content');
        $post->save();
        return redirect()->route('post.index', $post)->with('message', '更新が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index', $post)->with('message', '投稿を削除しました。');
    }
}
