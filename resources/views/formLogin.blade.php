@extends('layout')
@section('title')Вход@endsection
@section('content')

    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h3>Вход</h3>
        </div>
        <form action="{{route('login')}}" method="post">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="email">Почта</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="email@mail.com">
            </div> 
            <div class="form-group">
                <label for="password">Пароль</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>             
            <input class="btn btn-primary" type="submit" value="Войти">
        </form>
    </div>

@endsection
