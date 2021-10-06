<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'PostController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => '\App\Http\Controllers'], function () {
    Route::resource('Communities', 'CommunityController')->except(['create', 'edit']);
    Route::resource('Posts', 'PostController');
    Route::resource('Users', 'UsersController')->except(['show', 'create', 'index', 'store']);
    Route::resource('Comments', 'CommentController')->except(['show', 'create', 'index', 'edit']);
    Route::get('Posts/upVote/{Post}', 'PostController@upVote')->name('Posts.upVote');
    Route::get('Posts/downVote/{Post}', 'PostController@downVote')->name('Posts.downVote');
    Route::post('Communities/{community}', 'CommunityController@join')->name('Communities.join');
});
