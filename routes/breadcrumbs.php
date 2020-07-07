<?php
    Breadcrumbs::register('main', function ($trail) {
        $breadcrumbs->push('Главная', url('/'));
    });
    Breadcrumbs::register('profile', function ($trail) {
        $breadcrumbs->parent('main');
        $breadcrumbs->push('Профиль', url('/profile'));
    });
    Breadcrumbs::register('register', function ($trail) {
        $breadcrumbs->parent('main');
        $breadcrumbs->push('Регистрация', url('/register'));
    });
    Breadcrumbs::register('login', function ($trail) {
        $breadcrumbs->parent('main');
        $breadcrumbs->push('Регистрация', url('/login'));
    });
    Breadcrumbs::register('posts_all', function ($trail) {
        $breadcrumbs->parent('main');
        $breadcrumbs->push('Посты', url('/posts_all'));
    });
    Breadcrumbs::register('my_posts', function ($trail) {
        $breadcrumbs->parent('main');
        $breadcrumbs->push('Посты', url('/my_posts'));
    });
    Breadcrumbs::register('posts', function ($trail) {
        $breadcrumbs->parent('main');
        $breadcrumbs->push('Посты', url('/posts'));
    });
    Breadcrumbs::register('post', function ($trail, $post) {
        $breadcrumbs->parent('posts');
        $breadcrumbs->push($post->title, route('allpost.show', $post->id));
    });
    Breadcrumbs::register('post_edit', function ($trail, $post) {
        $breadcrumbs->parent('my_posts');
        $breadcrumbs->push('Редактирование: '.$post->title, route('my_posts.show', $post->id));
    });
    Breadcrumbs::register('comment_edit', function ($trail, $comment) {
        $breadcrumbs->parent('main');
        $breadcrumbs->push('Редактирование: '.$comment->title, route('comment.edit', $comment->id));
    });