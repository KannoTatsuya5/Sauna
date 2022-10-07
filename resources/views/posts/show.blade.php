@extends('layouts.app')

@section('content')
    <div class="border" style="width: 80%; margin: auto">
        <div class="m-4">
            <p><button class="btn btn-outline-primary me-2" onclick="window.history.back()">戻る</button>{{$post->updated_at}}</p>
            <h5>投稿者: {{ $post->user->name }}</h5>
            <h5>施設の名前: {{ $post->sauna_name }}</h5>
            <p>口コミ: <br>{{ $post->content }}</p>
            @if ($post->image_path)
                <div class="m-2"><img src="/upload/{{ $post->image_path }}" width="300"></div>
            @endif

            <div style="display:inline-flex">
                <form action="{{ route('reply.store', $post) }}" method="post">
                    @csrf
                    <input type="text" name="message" value="{{ old('message') }}">
                    <button type="submit">コメント</button>
                </form>
                @if ($user_id === $post->user_id)
                <a href="{{ route('post.edit', $post) }}" class="btn btn-outline-primary ms-3">編集</a>
                <form action="{{ route('post.destroy', $post) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger ms-3">削除</button>
                </form>
                @endif
            </div>
        </div>
        <div>
            @foreach ($replies as $reply)
                <p>{{$reply->message}}</p>
            @endforeach
        </div>
    </div>
@endsection
