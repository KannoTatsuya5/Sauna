@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('post.create') }}" class="btn btn-outline-primary me-2 mb-3">投稿</a>

        @foreach ($posts as $post)
            <div class="border">
                <div class="m-4">
                    <h5>投稿者: {{ $post->nickname }}</h5>
                    <h5>施設の名前: {{ $post->sauna_name }}</h5>
                    <p>口コミ: <br>{{ $post->content }}</p>
                    @if ($post->image_path)
                    <div class="m-2"><img src="upload/{{ $post->image_path }}" width="300"></div>
                    @endif
    
                    <div>
                        <a href="#" class="btn btn-outline-primary me-2">コメントをする</a>
                        <a href="{{ route('post.edit', $post)}}" class="btn btn-outline-primary me-2">編集</a>
                        <a href="#" class="btn btn-outline-danger">削除</a>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    </div>
@endsection
