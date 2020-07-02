@extends('layout')
@section('title')Посты@endsection
@section('content')
<div class="container">
<a class="btn btn-primary" href="{{route('posts.create')}}">Добавить новый пост</a>
<a class="btn btn-success" href="{{route('posts.exportexcel')}}">Экспортировать в Excel</a>
<a class="btn btn-success" href="{{route('posts.exportcsv')}}">Экспортировать в CSV</a>
<a class="btn btn-success" href="{{route('posts.exportxml')}}">Экспортировать в XML</a>
    @if(!empty($posts))
        @foreach($posts as $post)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>
                    <a href="{{route('posts.show', ['post' => $post->id])}}" class="btn btn-outline-primary">Изменить</a>
                    @foreach($post['images'] as $image)
                        <img width="100px" src="storage/images/{{$post->id}}/{{$image->title}}" alt="images">
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
            Пусто
     @endif
</div>
    
@endsection