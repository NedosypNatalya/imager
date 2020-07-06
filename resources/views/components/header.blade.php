<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal"><a href="{{route('main')}}">Название</a></h5>
  <nav class="my-2 my-md-0 mr-md-3">
  <a class="p-2 text-dark" href="{{route('posts.all')}}">Посты</a>
  @if(Auth::user())
    <a class="p-2 text-dark" href="{{route('my_posts.index')}}">Мои посты</a>
    <a class="p-2 text-dark" href="{{route('profile_form')}}">Профиль</a>
    <a class="p-2 text-dark" href="{{route('logout')}}">Выйти</a>
  </nav>
  @else
  <a class="btn btn-outline-success" href="{{route('register_form')}}">Регистрация</a>
  <a class="btn btn-outline-primary" href="{{route('login_form')}}">Войти</a>
  @endif
</div>