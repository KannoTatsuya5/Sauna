@extends('layouts.app')

@section('content')
<div class="border w-75 mx-auto">
        <form action="{{ route('post.index') }}">
            <div class="w-25 text-cente">
                <button type="submit" class="btn btn-outline-danger ms-5 mt-3 mb-3">戻る</button>
            </div>
        </form>
        <div class="m-4 text-center ">
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
            {{-- {{$replies->message}} --}}
            <div class="p-5">
                {!! $replies->links() !!}
            </div>
        </div>
    </div>
@endsection
