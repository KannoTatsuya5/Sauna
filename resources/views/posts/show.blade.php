@extends('layouts.app')

@section('content')
    <div class="border">
        <div class="m-4">
            <h5>投稿者: {{ $post->nickname }}</h5>
            <h5>施設の名前: {{ $post->sauna_name }}</h5>
            <p>口コミ: <br>{{ $post->content }}</p>
            @if ($post->image_path)
                <div class="m-2"><img src="/upload/{{ $post->image_path }}" width="300"></div>
            @endif

            <div style="display:inline-flex">
                <a href="{{ route('post.show', $post) }}" class="btn btn-outline-primary ms-4">コメントをする</a>
                <a href="{{ route('post.edit', $post) }}" class="btn btn-outline-primary ms-3">編集</a>
                <form action="{{ route('post.destroy', $post) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger ms-3">削除</button>
                </form>
            </div>
        </div>
    </div>
@endsection
