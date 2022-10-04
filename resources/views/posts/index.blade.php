@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="#" class="btn btn-outline-primary me-2 mb-3">投稿</a>

        @foreach ($posts as $post)
            <div class="border">
                <div class="m-4">
                    <h5>投稿者: {{ $post->nickname }}</h5>
                    <h5>施設の名前: {{ $post->sauna_name }}</h5>
                    <div>{{ $post->image_path }}</div>
                    <p>{{ $post->content }}</p>
    
                    <div>
                        <a href="#" class="btn btn-outline-primary me-2">詳細</a>
                        <a href="#" class="btn btn-outline-primary me-2">編集</a>
                        <a href="#" class="btn btn-outline-danger">削除</a>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    </div>
@endsection
