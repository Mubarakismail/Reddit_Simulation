<?php

use Illuminate\Support\Facades\Route;


Route::get('/','PostController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => '\App\Http\Controllers'], function () {
    Route::resource('Communities', 'CommunityController');
    Route::resource('Posts', 'PostController');
    Route::resource('Users', 'UsersController');
});
