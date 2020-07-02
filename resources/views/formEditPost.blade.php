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
        <form id="update" method="post" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
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
        <form id="delete" method="post" action="{{route('posts.destroy', ['post' => $post->id])}}">
            @method('DELETE')
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <button class="btn btn-danger" type="submit">Удалить пост</button>
        </form>
        @foreach($post['images'] as $image)
            <img width="100px" src="../storage/images/{{$post->id}}/{{$image->title}}" alt="{{$image->title}}">
            <form method="get" action="{{route('image_delete', ['post' => $post->id, 'image' => $image->id])}}">
                <input class="btn btn-outline-danger" type="submit" value="Удалить">
            </form>
        @endforeach
    </div>

@endsection