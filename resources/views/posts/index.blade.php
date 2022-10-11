@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
        <div class="flash_message bg-success text-center text-white py-3 my-0">
            {{session('message')}}
        </div>
        @endif
        <br>
        <form method="GET" action="{{ route('post.index') }}">
            <input type="search" class="w-100 h-auto" placeholder="行ってみたいサウナの口コミを探してみよう" name="search" value="@if (isset($search)) {{ $search }} @endif">
            <div align="center">
                <button class="mt-3" type="submit" style="width: 10%">検索</button>
                <button class="ms-3">
                    <a href="{{ route('post.index') }}" class="text-black">
                        クリア
                    </a>
                </button>
            </div>
        </form>
        <a href="{{ route('post.create') }}" class="btn btn-outline-primary me-2 mb-3">投稿</a>

        @foreach ($posts as $post)
            <div class="border">
                <div class="m-4">
                    <p>{{ $post->updated_at }}</p>
                    <a href="{{ route('user.detail', $post->user_id) }}" style="text-decoration: none; color: black">
                        <h5>投稿者: {{ $post->user->name }}</h5>
                    </a>
                    <h5>施設の名前: {{ $post->sauna_name }}</h5>
                    <p>口コミ: <br>{{ $post->content }}</p>
                    @if ($post->image_path)
                        <div class="m-2"><img src="upload/{{ $post->image_path }}" width="300"></div>
                    @endif

                    <div style="display:inline-flex">
                        <a href="{{ route('post.show', $post) }}" class="btn btn-outline-primary ms-2">コメントをする</a>
                    </div>
                    <span>
                        <!-- もし$niceがあれば＝ユーザーが「いいね」をしていたら -->
                        @if (!$post->nices->isEmpty())
                            @foreach ($post->nices as $nice)
                                @if ($nice->user_id == Auth::id())
                                    <!-- 「いいね」取消用ボタンを表示 -->
                                    <a href="{{ route('unnice', $post) }}" class="btn btn-success ms-2">
                                        ❤️
                                        <!-- 「いいね」の数を表示 -->
                                        <span class="badge">
                                            {{ $post->nices->count() }}
                                        </span>
                                    </a>
                                @else
                                    <a href="{{ route('nice', $post) }}" class="btn btn-primary ms-2">
                                        ❤️
                                        <!-- 「いいね」の数を表示 -->
                                        <span class="badge">
                                            {{ $post->nices->count() }}
                                        </span>
                                    </a>
                                @endif
                            @endforeach
                        @else
                            <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                            <a href="{{ route('nice', $post) }}" class="btn btn-primary ms-2">
                                ❤️
                                <!-- 「いいね」の数を表示 -->
                                <span class="badge">
                                    {{ $post->nices->count() }}
                                </span>
                            </a>
                        @endif
                    </span>
                </div>
            </div>
            <br>
        @endforeach
        <div  style="padding-bottom: 100px">
            {!! $posts->links() !!}
        </div>
    </div>
@endsection
