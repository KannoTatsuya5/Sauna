@extends('layouts.app')

@section('content')
    <div class="border h-100">
        <div class="m-4">
            <form action="{{ route('post.index') }}">
                <div>
                    <button type="submit" class="btn btn-outline-danger">戻る</button>
                </div>
            </form>
            </p>
            <a href="{{ route('user.detail', $post->user_id) }}" style="text-decoration: none; color: black">
                <h5>投稿者: {{ $post->user->name }}</h5>
            </a>
            <h5>施設の名前: {{ $post->sauna_name }}</h5>
            <p>口コミ: <br>{{ $post->content }}</p>
            @if ($post->image_path)
                <div class="m-2"><img src="/upload/{{ $post->image_path }}" width="300"></div>
            @endif

            <div>
                <form action="{{ route('reply.store', $post) }}" method="post">
                    @csrf
                    @error('reply_message')
                        <span style="color: red">1文字以上1500文字以内で入力してください</span>
                    @enderror
                    <br>
                    <textarea name="reply_message" value="{{ old('reply_message') }}" cols="48" rows="10"></textarea>
                    <br>
                    <button type="submit" class="btn btn-outline-success">コメント</button>
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
                    <h5>コメント：</h5>
                    <p>{{ $reply->created_at }}:{{ $reply->user->name }}<br>{{ $reply->message }}</p>
                </div>
                <hr>
            @endforeach
            <div style="padding-bottom: 130px"></div>
            {{-- {{$replies->message}} --}}
            <div  style="padding-bottom: 100px">
                {!! $replies->links() !!}
            </div>
        </div>
    </div>
@endsection
