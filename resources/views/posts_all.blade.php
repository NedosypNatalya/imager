@extends('layout')
@section('title')Посты@endsection
@section('content')
<div class="container">
    @if(!empty($posts))
        @foreach($posts as $post)
            <div class="card">
                <div class="card-body">
                    <a href="{{route('allpost.show', ['post' => $post->id])}}"><h5 class="card-title">{{ $post->title }}</h5></a>
                    <p class="card-text">{{ $post->content }}</p>
                    <a href="{{route('allpost.show', ['post' => $post->id])}}" class="btn btn-outline-primary">Показать</a>
                    @foreach($post->images as $image)
                        <img width="100px" src="storage/images/{{$image->title}}" alt="images">
                    @endforeach
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    @else
            Пусто
    @endif
</div>
    
@endsection