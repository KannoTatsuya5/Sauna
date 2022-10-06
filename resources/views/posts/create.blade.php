@extends('layouts.app')

@section('content')
    <form action="{{ route('post.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="container">
            <h5>投稿者: {{ Auth::user()->name }}</h5>
            @error('sauna_name')
                <span style="color: red">施設の名前を入力してください</span>
            @enderror
            <br>
            <label for="sauna_name">施設の名前:</label>
            <input type="text" id="sauna_name" class="form-control" name="sauna_name" value="{{ old('sauna_name') }}">
            <br>
            <br>
            <label for="image_path">施設の画像:</label>
            <input type="file" name="image_path" id="image_path" class="form-control" name="image_path">
            <br>
            @error('content')
                <span style="color: red">口コミを入力してください</span>
            @enderror
            <br>
            <label for="content">口コミ:</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
        </div>
        <div align="center">
            <button type="submit" class="btn btn-outline-primary mt-3 fs-5">投稿</button>
        </div>
    </form>
    <form action="{{ route('post.index')}}">
        <div align="center">
            <button type="submit" class="btn btn-outline-danger mt-3 fs-5">戻る</button>
        </div>
    </form>
@endsection
