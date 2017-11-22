<?php

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

Route::get('admin', 'LoginController@showLoginForm');
Route::post('admin', 'LoginController@login')->name('admin');
Route::post('logout', 'LoginController@logout');

Route::get('/', 'MainController@home');

Route::resource('/posts', 'PostController');

Route::get('/tag/{tag}', 'TagController@index');
Route::get('/json/tag-search', 'TagController@jsonSearch');
