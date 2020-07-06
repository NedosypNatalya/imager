@extends('layout')
@section('title'){{$post->title}}@endsection
@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h3>Автор: {{$post->user->name}}</h3>
                <h1 class="display-4">{{$post->title}}</h1>
                <p class="lead">{{$post->content}}</p>
            </div>
            @foreach($post->images as $image)
                <img width="300px" src="../storage/images/{{$post->id}}/{{$image->title}}" alt="{{$image->title}}">
            @endforeach
        </div>
        @if(Auth::user())
        <form id="form-add-comment" method="post" action="{{ route('comment.store') }}">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="text">Комментарий</label>
                <textarea class="form-control" name="text" id="text" cols="30" rows="2"></textarea>
            </div>
            <div class="form-group">
                <input post-id="{{ $post->id }}" id="store-comment" class="btn btn-primary" type="submit" value="Оставить комментарий">
            </div>
        </form>
        @endif
        <div id="comments-block">
            @foreach($post->comments as $comment)
                <div class="alert alert-secondary" role="alert">
                    <a href="#" class="alert-link">{{ $comment->user->name }}</a>{{ $comment->text }}
                    @if(!empty(Auth::user()))
                        @if($post->user == Auth::user() || $comment->user_id == Auth::user()->id)
                            @if($comment->user_id == $post->user_id || $comment->user_id == Auth::user()->id)
                                <form method="get" action="{{route('comment.edit', ['comment' => $comment->id])}}">
                                {{ csrf_field() }}
                                    <input class="btn btn-outline-primary" type="submit" value="Изменить">
                                </form>
                            @endif
                            <form  method="post" action="{{route('comment.destroy', ['comment' => $comment->id])}}">
                                @method('DELETE')
                                {{ csrf_field() }}
                                <input class="btn btn-outline-danger" type="submit" value="Удалить">
                            </form>
                        @endif
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection