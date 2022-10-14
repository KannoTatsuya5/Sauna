@extends('layouts.app')

@section('content')
    @foreach ($posts as $post)
        <p>{{ $post->sauna_name}}</p>        
    @endforeach
@endsection