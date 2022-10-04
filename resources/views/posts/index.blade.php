@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($posts as $post)
            <div>{{ $post->nickname }}</div>
            <div>{{ $post->sauna_name }}</div>
            <div>{{ $post->image_path }}</div>
            <div>{{ $post->content }}</div>

            <a href="#">編集</a>
            <a href="#">削除</a>
        @endforeach
    </div>
@endsection
