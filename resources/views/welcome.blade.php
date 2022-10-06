@extends('layouts.app')

@section('content')
<div class="container mt-5" style="text-align: center; padding: 30px;">
    <h2>ようこそ、サウナ研究会へ</h2>
    <h4 class="mt-3">みんなの口コミを頼りにあなたのベストサウナを探そう！</h4>
    <strong class="mt-3">
        <a href="{{ route('post.index') }}" style="color: black">
            <button class="btn btn-outline-primary ">みんなの口コミを見る</button>
        </a>
    </strong>
</div>
@endsection