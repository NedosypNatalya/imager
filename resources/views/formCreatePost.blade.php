@extends('layout')
@section('title')Создание поста@endsection
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
            <h3>Создание поста</h3>
        </div>
        <form method="post" action="{{ route('my_posts.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input class="form-control" type="text" name="title" id="title" placeholder="Заголовок">
            </div>
            <div class="form-group">
                <label for="content">Содержимое</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10">Текст</textarea>
            </div>
            <div class="form-group">
                <label for="file">Прикрепить изображение</label>
                <input class="form-control-file" type="file" multiple name="file[]">
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <button class="btn btn-primary" type="submit">Загрузить</button>
        </form>
    </div>

@endsection