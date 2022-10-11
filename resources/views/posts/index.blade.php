@extends('layouts.app')

@section('content')
    <div class="container">
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
    </div>
@endsection
