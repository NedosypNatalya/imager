@extends('layout')
@section('title')Регистрация@endsection
@section('content')
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h3>Регистрация</h3>
        </div>
        @if ($errors->all())
		<div class="alert alert-danger">
			@foreach($errors->all() as $error)
			<p>{{ $error }}</p>
			@endforeach
		</div>
	    @endif
        <form action="{{route('register')}}" method="post" id="registerform">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Имя</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="Иван">
            </div> 
            <div class="form-group">
                <label for="email">Почта</label>
                <input list="items-email" class="form-control" type="email" name="email" id="email" placeholder="email@mail.com">
                <datalist id="items-email">
                </datalist>
            </div> 
            <div class="form-group">
                <label for="password">Пароль</label>
                <input class="form-control" type="password" name="password" id="password">
            </div> 
            <div class="form-group">
                <label for="c_password">Повторение пароля</label>
                <input class="form-control" type="password" name="c_password" id="c_password">
            </div>
            <div class="form-group">
                <label for="address">Адрес</label>
                <input list="items-address" class="form-control" type="text" name="address" id="address">
                <datalist id="items-address">
                </datalist>
            </div>           
            <input class="btn btn-primary" type="submit" value="Регистрация">
        </form>
    </div>

@endsection
