@extends('layout')
@section('title')Главная@endsection
@section('content')
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1>Главная страница</h1>
            @if(isset($posts) && !empty($posts))
                @foreach($posts as $post)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            @foreach($post['images'] as $image)
                                <img width="100px" src="storage/images/{{$post->id}}/{{$image->title}}" alt="images">
                            @endforeach
                        </div>
                    </div>
                @endforeach
                {{ $posts->links() }}
            @endif
        </div>
    </div>
@endsection