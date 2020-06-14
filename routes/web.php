<?php

use LaravelLocalization as Lang;

Route::prefix(Lang::setLocale())->middleware(['session', 'filter', 'view', 'localize'])->group(static function () {
    Route::view('/', 'home')->name('home')->middleware('verified');
});
