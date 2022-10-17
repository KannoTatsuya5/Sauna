@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <div class="flash_message bg-success text-center text-white py-3 my-0">
                {{ session('message') }}
            </div>
        @endif
        <br>

        <form method="GET" action="{{ route('post.index') }}" style="text-align: center">
            <input type="search" class="w-50 h-auto" placeholder="行ってみたいサウナの口コミを探してみよう" name="search"
                value="@if (isset($search)) {{ $search }} @endif">
            <div>
                <button class="mt-3 w-25 btn btn-primary" type="submit">検索</button>
                <button class="mt-3 ms-3 btn btn-light" style="border:1px solid #333">
                    <a href="{{ route('post.index') }}" class="text-black">
                        クリア
                    </a>
                </button>
            </div>
        </form>
        <div class="w-25 text-center">
            <a href="{{ route('post.create') }}" class="btn btn-outline-primary ms-5 mt-3 mb-3">投稿</a>
        </div>

        @if ($no_item_message != null)
            <h4 class="mt-5 text-center">{{ $no_item_message }}</h4>
        @endif

        @foreach ($posts as $post)
            <div>
                <div class="p-5 w-75 border mx-auto">
                    <p>{{ $post->updated_at }}</p>
                    <a href="{{ route('user.detail', $post->user_id) }}" style="text-decoration: none; color: black">
                        <h5>投稿者: {{ $post->user->name }}</h5>
                    </a>
                    <h5>施設の名前: {{ $post->sauna_name }}</h5>
                    <p>口コミ: <br>{{ $post->content }}</p>
                    @if ($post->image_path)
                        <div class="m-2"><img src="upload/{{ $post->image_path }}" class="w-50"></div>
                    @endif

                    <div style="display:inline-flex">
                        <a href="{{ route('post.show', $post) }}" class="btn btn-outline-primary ms-2">コメントをする</a>
                    </div>
                    <div class="row justify-content-center">
                        @if ($post->users()->where('user_id', Auth::id())->exists())
                            <div class="col-md-3">
                                <form action="{{ route('unfavorites', $post) }}" method="POST">
                                    @csrf
                                    <input type="submit" value="🤍取り消し" class="btn btn-danger">
                                </form>
                                <div class="row justify-content-center">
                                    <p>いいね数：{{ $post->users()->count() }}</p>
                                </div>
                            </div>
                        @else
                            <div class="col-md-3">
                                <form action="{{ route('favorites', $post) }}" method="POST">
                                    @csrf
                                    <input type="submit" value="❤️いいね" class="btn btn-outline-primary">
                                </form>
                                <div class="row justify-content-center">
                                    <p>いいね数：{{ $post->users()->count() }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <br>
        @endforeach
        <div class="p-5">
            {!! $posts->links() !!}
        </div>
    </div>
@endsection
