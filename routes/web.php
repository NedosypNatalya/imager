<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/register', 'FormController@register')->name('register_form');
Route::post('/register', 'RegisterController@register')->name('register');
//Route::post('/register/address', 'RegisterController@setAddress');
//Route::post('/register/email', 'RegisterController@setEmail');
Route::post('/register/address', 'RegisterController@setData');
Route::post('/register/email', 'RegisterController@setData');

Route::get('/login', 'FormController@login')->name('login_form');
Route::post('/login', 'LoginController@login')->name('login');
Route::get('/logout', 'LogoutController@logout')->name('logout');

Route::get('/profile/{user}', 'FormController@profile')->name('profile_form');
Route::post('/profile', 'ProfileController@profileUpdate')->name('profile_update');

Route::resource('posts', 'PostController');

Route::get('posts/{post}/delele-image-{image}', 'PostController@imageDelete')->name('image_delete');

Route::get('/export/excel', 'PostController@exportExcel')->name('posts.exportexcel');
Route::get('/export/scv', 'PostController@exportCSV')->name('posts.exportcsv');
Route::get('/export/xml', 'PostController@exportXML')->name('posts.exportxml');