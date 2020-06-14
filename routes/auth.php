<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use LaravelLocalization as Lang;

Route::prefix(Lang::setLocale())->middleware(['session', 'filter', 'view', 'localize'])->group(static function () {
    // Routes with layout...
    Route::layout('layouts.auth')->group(static function () {
        Route::middleware('guest')->group(static function () {
            // Authentication Routes...
            Route::livewire(Lang::transRoute('routes.login'), 'auth.login')->name('login');
            // Registration Routes...
            if (config('settings.registration') ?? true) {
                Route::livewire(Lang::transRoute('routes.register'), 'auth.register')->name('register');
            }
        });

        // Password Reset Routes...
        if (config('settings.reset_password') ?? true) {
            Route::livewire(
                Lang::transRoute('routes.password') . '/' . Lang::transRoute('routes.reset'),
                'auth.passwords.email'
            )->name('password.request');
            Route::livewire(
                Lang::transRoute('routes.password') . '/' . Lang::transRoute('routes.reset') . '/{token}',
                'auth.passwords.reset'
            )->name('password.reset');
        }

        Route::middleware('auth')->group(static function () {
            // Email Verification Routes...
            if (config('settings.email_verification') ?? false) {
                Route::livewire(
                    Lang::transRoute('routes.email') . '/' . Lang::transRoute('routes.verify'),
                    'auth.verify'
                )->middleware('throttle:6,1')->name('verification.notice');
            }
            // Password Confirmation Routes...
            if (config('settings.email_confirmation') ?? false) {
                Route::livewire(
                    Lang::transRoute('routes.password') . '/' . Lang::transRoute('routes.confirm'),
                    'auth.passwords.confirm'
                )->name('password.confirm');
            }
        });
    });

    Route::middleware('auth')->group(static function () {
        // Email Verification Routes...
        // Logout Routes...
        Route::post(Lang::transRoute('routes.logout'), LogoutController::class)->name('logout');
    });
});

if (config('settings.email_verification') ?? false) {
    Route::get(
        Lang::transRoute('routes.email') . '/' . Lang::transRoute('routes.verify') . '/{id}/{hash}',
        EmailVerificationController::class
    )->middleware('signed')->name('verification.verify');
}
