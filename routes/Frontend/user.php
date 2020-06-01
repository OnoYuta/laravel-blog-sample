<?php

// user unauthenticated
Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return view('frontend.welcome');
    });
    Route::resource('/posts', 'PostController', ['only' => ['index']])->names('posts');

    Auth::routes(['verify' => true]);
});

// user authenticated
Route::middleware(['web', 'auth:user', 'verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
});
