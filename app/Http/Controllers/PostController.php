<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use App\Models\Nice;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * 投稿された情報の一覧表示.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Request $request)
    {
        // 新しい順で一覧表示(user情報を渡している)
        $posts = Post::with('user')->with('nices')->latest()->paginate(5);

        $search = $request->input('search');

        $no_item_message = null;

        // クエリビルダ
        $query = Post::query();

        // もし検索フォームにキーワードが入力されたら
        if ($search) {

            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');

            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);


            // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach ($wordArraySearched as $value) {
                $query->where('sauna_name', 'like', '%' . $value . '%')->latest();
            }
            $posts = $query->paginate(5);

            if ($posts[0] == null) {
                $no_item_message = "該当する施設の口コミがありません。他のキーワードで検索してみよう!";
            }
        }


        //変数$postsをposts/index.blade.phpに渡す
        return view('posts.index', compact('posts'))->with([
            'post' => $posts,
            'search' => $search,
            'no_item_message' => $no_item_message,
        ]);
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
        if (!empty($file)) {
            $filename = $file->getClientOriginalName();
            $file->move('./upload/', $filename);
        } else {
            $filename = "";
        }

        $request->validate([
            'sauna_name' => 'required | min:1 | max:255',
            'content' => 'required | min:1 | max: 355',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
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
        $posts = Post::with('user')->latest()->get();
        $replies = Reply::where('post_id', $post->id)->paginate(10);

        return view('posts.show', compact('posts', 'post', 'replies'))->with('user_id', Auth::id());
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
        if (!empty($file)) {
            $filename = $file->getClientOriginalName();
            $file->move('./upload/', $filename);
        } else {
            $filename = "";
        }

        $request->validate([
            'sauna_name' => 'required | min:1 | max:255',
            'content' => 'required | min:1 | max: 355',
        ]);

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
