@extends('layouts.app')

@section('content')
    <form action="{{ route('post.edit') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="container">
            @error('nickname')
                <span style="color: red">ニックネームを入力してください</span>
            @enderror
            <br>
            <label for="nickname">ニックネーム:</label>
            <input type="text" id="nickname" class="form-control" name="nickname" value="{{ old('nickname')}}">
            <br>
            @error('sauna_name')
                <span style="color: red">施設の名前を入力してください</span>
            @enderror
            <br>
            <label for="sauna_name">施設の名前:</label>
            <input type="text" id="sauna_name" class="form-control" name="sauna_name" value="{{ old('sauna_name')}}">
            <br>
            <br>
            <label for="image_path">施設の画像:</label>
            <input type="file" name="image_path" id="image_path" class="form-control" name="image_path" value="{{ old('image_path')}}">
            <br>
            @error('content')
                <span style="color: red">口コミを入力してください</span>
            @enderror
            <br>
            <label for="content">口コミ:</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control">value="{{ old('content')}}"</textarea>
        </div>
        <div align="center">
            <button type="submit" class="btn btn-outline-primary mt-3 fs-5">編集</button>
        </div>
    </form>
@endsection
