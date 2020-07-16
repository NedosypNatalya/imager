<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', 'API\RegisterController@register')->name('register_api');
Route::post('login', 'API\LoginController@login')->name('login_api');

Route::get('all_posts', 'API\PostController@getAllPosts');
Route::get('posts/{post}/comments', 'API\CommentController@showCommentsSinglePost');
Route::get('/comments', 'API\CommentController@showAllComments');
Route::middleware('auth:api')->group( function () {
    Route::resource('posts', 'API\PostController')->except(['update']);
    Route::post('posts/{post}/update', 'API\PostController@update')->name('post_update');
    Route::delete('images/{image}', 'API\ImageController@delete')->name('delete_image');
    Route::post('logout', 'API\LogoutController@logout')->name('logout_api');
    Route::put('profile', 'API\ProfileController@update')->name('profile_api');
    Route::get('profile', 'API\ProfileController@show');
    Route::resource('/posts/{post}/comment', 'API\CommentController')->except(['edit', 'show', 'index', 'update']);
    Route::post('posts/{post}/comment/{comment}/update', 'API\CommentController@update')->name('comment_update');
});
