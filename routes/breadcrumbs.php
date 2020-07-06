<?php
    Breadcrumbs::register('main', function ($breadcrumbs) {
        $breadcrumbs->push('Главная', url('/'));
    });
    Breadcrumbs::register('profile', function ($breadcrumbs) {
        $breadcrumbs->push('Главная', url('/'));
        $breadcrumbs->push('Профиль', url('/profile'));
    });