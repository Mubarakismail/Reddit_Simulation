<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'PostController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => '\App\Http\Controllers'], function () {
    Route::resource('Communities', 'CommunityController')->except(['create', 'edit']);
    Route::resource('Posts', 'PostController');
    Route::resource('Users', 'UsersController')->except(['show', 'create', 'index', 'edit', 'store']);
    Route::resource('Comments', 'CommentController')->except(['show', 'create', 'index', 'edit']);
});
