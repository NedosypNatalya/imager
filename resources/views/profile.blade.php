@extends('layout')
@section('title')Профиль@endsection
@section('content')
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h3>Редактировать профиль <b>{{$user->name}}</b></h3>
        </div>

        @if(isset($message))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif

        <form method="post" action="{{ route('profile_update') }}">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">Имя</label>
                <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="email">Почта</label>
                <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input class="form-control" type="password" name="password" id="password">
            </div> 
            <div class="form-group">
                <label for="c_password">Повторение пароля</label>
                <input class="form-control" type="password" name="c_password" id="c_password">
            </div>
            <input type="hidden" name="id" value="{{$user->id}}">
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </form>
    </div>
@endsection