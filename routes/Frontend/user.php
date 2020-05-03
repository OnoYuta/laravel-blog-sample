<?php

// user unauthenticated
Route::middleware('web')->group(function () {
    Auth::routes();
});

// user authenticated
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
});
