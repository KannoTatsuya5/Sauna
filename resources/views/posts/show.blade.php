@extends('layouts.app')

@section('content')
    <div class="container text-center border w-75">
        <form action="{{ route('post.index') }}">
            <div class="w-25 text-cente">
                <button type="submit" class="btn btn-outline-danger ms-5 mt-3 mb-3">戻る</button>
            </div>
        </form>
        <div class="m-4">
            </p>
            <a href="{{ route('user.detail', $post->user_id) }}" style="text-decoration: none; color: black">
                <h5>投稿者: {{ $post->user->name }}</h5>
            </a>
            <h5>施設の名前: {{ $post->sauna_name }}</h5>
            <p>口コミ: <br>{{ $post->content }}</p>
            @if ($post->image_path)
                <div class="m-2"><img src="/upload/{{ $post->image_path }}" class="w-50"></div>
            @endif

            <div>
                <form action="{{ route('reply.store', $post) }}" method="post">
                    @csrf
                    @error('reply_message')
                        <span style="color: red">1文字以上1500文字以内で入力してください</span>
                    @enderror
                    <br>
                    <textarea name="reply_message" value="{{ old('reply_message') }}" class="w-50" rows="10"></textarea>
                    <br>
                    <button type="submit" class="btn btn-outline-success">コメント</button>
                    <span>
                        <!-- ユーザーが「いいね」をしていたら -->
                        @if (!$post->nices->isEmpty())
                            @foreach ($post->nices as $nice)
                                @if ($nice->user_id == Auth::id())
                                    <!-- 「いいね」取消用ボタンを表示 -->
                                    <a href="{{ route('unnice', $post) }}" class="btn btn-danger ms-2">
                                        🤍
                                        <!-- 「いいね」の数を表示 -->
                                        <span class="badge">
                                            {{ $post->nices->count() }}
                                        </span>
                                    </a>
                                @else
                                    <a href="{{ route('nice', $post) }}" class="btn btn-outline-primary ms-2">
                                        ❤️
                                        <!-- 「いいね」の数を表示 -->
                                        <span class="badge text-black">
                                            {{ $post->nices->count() }}
                                        </span>
                                    </a>
                                @endif
                            @endforeach
                        @else
                            <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                            <a href="{{ route('nice', $post) }}" class="btn btn-outline-primary ms-2">
                                ❤️
                                <!-- 「いいね」の数を表示 -->
                                <span class="badge text-black">
                                    {{ $post->nices->count() }}
                                </span>
                            </a>
                        @endif
                    </span>
                </form>
                
                @if (Auth::id() === $post->user_id)
                    <div style="display:inline-flex" class="mt-2">
                        <a href="{{ route('post.edit', $post) }}" class="btn btn-outline-primary">編集</a>
                        <form action="{{ route('post.destroy', $post) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger ms-3">削除</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div>
            @foreach ($replies as $reply)
                <hr>
                <div class="ms-4">
                    <h4>{{ $reply->created_at }}:{{ $reply->user->name }}さんからのコメント：</h4>
                    <p>{{ $reply->message }}</p>
                </div>
                <hr>
            @endforeach
            {{-- {{$replies->message}} --}}
            <div class="p-5">
                {!! $replies->links() !!}
            </div>
        </div>
    </div>
@endsection
