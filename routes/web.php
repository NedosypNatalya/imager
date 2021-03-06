<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('main');


Route::middleware('auth:web')->group( function () {
    Route::resource('/my_posts', 'PostController');
    Route::get('/my_posts/{my_post}/delele-image-{image}', 'PostController@imageDelete')->name('image_delete');
    Route::get('/logout', 'LogoutController@logout')->name('logout');
    Route::get('/profile', 'ProfileController@getProfile')->name('profile_form');
    Route::post('/profile', 'ProfileController@profileUpdate')->name('profile_update');
    Route::get('/export/excel', 'PostController@exportExcel')->name('posts.exportexcel');
    Route::get('/export/scv', 'PostController@exportCSV')->name('posts.exportcsv');
    Route::get('/export/xml', 'PostController@exportXML')->name('posts.exportxml');
    Route::post('/comment/store', 'CommentController@store')->name('comment.store');
    Route::resource('/comment', 'CommentController')->except(['show', 'store']);
    Route::get('/comment/{comment}/edit', 'CommentController@edit')->name('comment.edit');
    Route::get('/comment/{comment}/delete', 'CommentController@destroy')->name('comment.delete');
    Route::post('/comment/images', 'CommentController@showImagesCommentForm')->name('comment.images');
});

Route::get('/register', 'RegisterController@getRegisterForm')->name('register_form');
Route::post('/register', 'RegisterController@register')->name('register');
Route::post('/register/address', 'RegisterController@setData');
Route::post('/register/email', 'RegisterController@setData');
Route::get('/login', 'LoginController@getLoginForm')->name('login_form');
Route::post('/login', 'LoginController@login')->name('login');
Route::get('/posts_all', 'PostController@getAll')->name('posts.all');
Route::get('/posts/{post}', 'PostController@showPost')->name('allpost.show');