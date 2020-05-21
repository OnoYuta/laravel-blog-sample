<?php

// admin unauthenticated
Route::middleware('web')->group(function () {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');

    // Redirect route for Laravel-admin...
    Route::redirect('auth/login', '/login', 301);
    Route::redirect('auth/logout', '/logout', 301);

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Email Verification Routes...
    Route::get('email/verify', 'Auth\VerificationController@show')->name('admin.verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('admin.verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('admin.verification.resend');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.update');
});

// admin authenticated
Route::middleware(['web', 'auth:admin', 'verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('admin.home');

    Route::get('auth/setting', 'Auth\AuthController@getSetting')->name('admin.setting');
    Route::put('auth/setting', 'Auth\AuthController@putSetting');
});
