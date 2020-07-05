@extends('layout')
@section('title')Изменить пост@endsection
@section('content')
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
  </div>
@endif
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h3>Редактирование поста</h3>
        </div>
        @if(isset($message))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
        <form id="update" method="post" action="{{ route('my_posts.update', ['my_post' => $post->id]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input class="form-control" type="text" name="title" id="title" placeholder="Заголовок" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <label for="content">Содержимое</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{$post->content}}</textarea>
            </div>
            <div class="form-group">
                <label for="file">Прикрепить изображение</label>
                <input class="form-control-file" type="file" multiple name="file[]">
            </div>
            <input type="hidden" name="id" value="{{$post->id}}">
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </form>
        <form id="delete" method="post" action="{{route('my_posts.destroy', ['my_post' => $post->id])}}">
            @method('DELETE')
            {{ csrf_field() }}
            <button class="btn btn-danger" type="submit">Удалить пост</button>
        </form>
        @foreach($post->images as $image)
            <img width="100px" src="../storage/images/{{$post->id}}/{{$image->title}}" alt="{{$image->title}}">
            <form method="get" action="{{route('image_delete', ['my_post' => $post->id, 'image' => $image->id])}}">
                <input class="btn btn-outline-danger" type="submit" value="Удалить">
            </form>
        @endforeach
        <form id="form-add-comment" method="post" action="{{ route('comment.store') }}">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="text">Комментарий</label>
                <textarea class="form-control" name="text" id="text" cols="30" rows="2"></textarea>
            </div>
            <div class="form-group">
                <input post-id="{{ $post->id }}" id="store-comment-edit-post" class="btn btn-primary" type="submit" value="Оставить комментарий">
            </div>
        </form>
        <div id="comments-block">
            @foreach($post->comments as $comment)
                <div class="alert alert-secondary" role="alert">
                    <a href="#" class="alert-link">{{ $comment->user->name }}</a>{{ $comment->text }}
                        @if($comment->user_id == $post->user_id)
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
                </div>
            @endforeach
        </div>
    </div>

@endsection