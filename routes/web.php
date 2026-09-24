<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {

    // ── Public front routes ───────────────────────────────────────────────
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio.index');
    Route::get('/portfolio/{id}', [HomeController::class, 'client'])->whereNumber('id')->name('portfolio.show');
    Route::post('/contact', [HomeController::class, 'contact'])->middleware('throttle:6,1')->name('contact.store');

});
