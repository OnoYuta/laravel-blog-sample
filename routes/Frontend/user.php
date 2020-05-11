<?php

// user unauthenticated
Route::middleware('web')->group(function () {
    Auth::routes(['verify' => true]);
});

// user authenticated
Route::middleware(['web', 'auth:user', 'verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
});
