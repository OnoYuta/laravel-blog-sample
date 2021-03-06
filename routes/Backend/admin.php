<?php

// admin unauthenticated
Route::middleware('web')->group(function () {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');

    // Redirect route for Laravel-admin...
    Route::redirect('auth/logout', '/logout', 301);
    Route::redirect('auth/setting', '/setting', 301);

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
Route::middleware(['web', 'auth:admin', 'laravel-admin', 'verified'])->group(function () {

    // Dashboard
    Route::get('/', 'HomeController@index')->name('admin.home');

    // Default Routes...
    Route::get('setting', 'Auth\AuthController@getSetting')->name('admin.setting');
    Route::put('setting', 'Auth\AuthController@putSetting');

    Route::resource('roles', '\Encore\Admin\Controllers\RoleController')->names('admin.auth.roles');
    Route::resource('permissions', '\Encore\Admin\Controllers\PermissionController')->names('admin.auth.permissions');
    Route::resource('menu', '\Encore\Admin\Controllers\MenuController', ['except' => ['create']])->names('admin.auth.menu');
    Route::resource('logs', '\Encore\Admin\Controllers\LogController', ['only' => ['index', 'destroy']])->names('admin.auth.logs');

    Route::post('_handle_form_', '\Encore\Admin\Controllers\HandleController@handleForm')->name('admin.handle-form');
    Route::post('_handle_action_', '\Encore\Admin\Controllers\HandleController@handleAction')->name('admin.handle-action');

    // Resource Routes...
    Route::resource('administrators', 'AdministratorController')->names('admin.administrators');
    Route::resource('posts', 'PostController')->names('admin.posts');
});
