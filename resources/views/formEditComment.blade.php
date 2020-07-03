@extends('layout')
@section('title')Изменить комментарий@endsection
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
            <h3>Редактирование комментария</h3>
        </div>
        @if(isset($message))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
        <form id="update" method="post" action="{{ route('comment.update', ['comment' => $comment->id]) }}">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label for="content">Комментарий</label>
                <textarea class="form-control" name="content" id="text" cols="30" rows="5">{{$comment->text}}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </form>
        <form id="delete" method="post" action="{{route('comment.destroy', ['comment' => $comment->id])}}">
            @method('DELETE')
            {{ csrf_field() }}
            <button class="btn btn-danger" type="submit">Удалить комментарий</button>
        </form>
    </div>

@endsection