<?php

use LaravelLocalization as Lang;

Route::prefix(Lang::setLocale())->middleware(['session', 'filter', 'view', 'localize'])->group(static function () {
    // Authentication Routes...
    Route::get(Lang::transRoute('routes.login'), 'Auth\LoginController@showLoginForm')->name('login');
    Route::post(Lang::transRoute('routes.login'), 'Auth\LoginController@login');
    Route::post(Lang::transRoute('routes.logout'), 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    if (config('main.register') ?? true) {
        Route::get(Lang::transRoute('routes.register'), 'Auth\RegisterController@showRegistrationForm')
            ->name('register');
        Route::post(Lang::transRoute('routes.register'), 'Auth\RegisterController@register');
    }

    // Password Reset Routes...
    if (config('main.reset') ?? true) {
        Route::get(
            Lang::transRoute('routes.password').'/'.Lang::transRoute('routes.reset'),
            'Auth\ForgotPasswordController@showLinkRequestForm'
        )->name('password.request');
        Route::post(
            Lang::transRoute('routes.password').'/'.Lang::transRoute('routes.email'),
            'Auth\ForgotPasswordController@sendResetLinkEmail'
        )->name('password.email');
        Route::get(
            Lang::transRoute('routes.password').'/'.Lang::transRoute('routes.email').'/{token}',
            'Auth\ResetPasswordController@showResetForm'
        )->name('password.reset');
        Route::post(
            Lang::transRoute('routes.password').'/'.Lang::transRoute('routes.reset'),
            'Auth\ResetPasswordController@reset'
        )->name('password.update');
    }

    // Password Confirmation Routes...
    if (config('main.confirm') ?? false) {
        Route::get(
            Lang::transRoute('routes.password').'/'.Lang::transRoute('routes.confirm'),
            'Auth\ConfirmPasswordController@showConfirmForm'
        )->name('password.confirm');
        Route::post(
            Lang::transRoute('routes.password').'/'.Lang::transRoute('routes.confirm'),
            'Auth\ConfirmPasswordController@confirm'
        );
    }

    // Email Verification Routes...
    if (config('main.verify') ?? false) {
        Route::get(
            Lang::transRoute('routes.email').'/'.Lang::transRoute('routes.verify'),
            'Auth\VerificationController@show'
        )->name('verification.notice');
        Route::get(
            Lang::transRoute('routes.email').'/'.Lang::transRoute('routes.verify').'/{id}/{hash}',
            'Auth\VerificationController@verify'
        )->name('verification.verify');
        Route::post(
            Lang::transRoute('routes.email').'/'.Lang::transRoute('routes.resend'),
            'Auth\VerificationController@resend'
        )->name('verification.resend');
    }
});
