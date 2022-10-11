@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="background-color: rgba(231, 230, 230, 0.859); border-radius: 30px; width: 100%; height: 100%">
            <div class="mt-5 ms-5">
                <h3 style="padding-top: 30px">{{ $user->name }}</h3>
                <p>サウナ歴: {{ $user->sauna_history }}</p>
                <p>ホーム: {{ $user->home_sauna }}</p>
                <p>好きなサウナ: {{ $user->like_sauna }}</p>
                <p>プロフィール: {{ $user->profile }}</p>
                @if ($user->link)
                    <p>リンク: <a style="text-decoration: none; color: black" href="{{ $user->link }}">{{ $user->link }}</a>
                    </p>
                @else
                    <p>リンク: リンクはありません</p>
                @endif
            </div>
            <div class="ms-5" style="padding-bottom: 30px">
                <button class="btn btn-outline-danger" onclick="window.history.back()">戻る</button>
            </div>
        </div>
        <div>
            <div class="fs-4 mt-3" style="background-color: rgba(231, 230, 230, 0.859);border-radius: 30px ;padding: 15px">
                {{ $user->name }}さんの投稿一覧</div>
            <hr>
            @foreach ($posts as $post)
                <div class="mt-3" style="background-color: rgba(231, 230, 230, 0.859);border-radius: 30px; padding: 15px">
                    <p>{{ $post->updated_at }}</p>
                    <strong class="fs-5">施設の名前: {{ $post->sauna_name }}</strong>
                    <p>口コミ: <br>{{ $post->content }}</p>
                    @if ($post->image_path)
                        <div class="m-2"><img src="/upload/{{ $post->image_path }}" width="300"></div>
                    @endif
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
                <hr>
            @endforeach
            <div  style="padding-bottom: 100px">
                {!! $posts->links() !!}
            </div>
        </div>

    </div>
@endsection
