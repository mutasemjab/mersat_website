<?php

use App\Http\Controllers\Admin\ClientLogoController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PortfolioItemController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\TickerItemController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Permission\Models\Permission;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {

        // ── Dashboard ─────────────────────────────────────────────────
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

        // ── Admin profile ─────────────────────────────────────────────
        Route::get('/admin/edit/{id}',    [LoginController::class, 'editlogin'])->name('admin.login.edit');
        Route::post('/admin/update/{id}', [LoginController::class, 'updatelogin'])->name('admin.login.update');

        // ── Roles & Employees ─────────────────────────────────────────
        Route::resource('employee', EmployeeController::class, ['as' => 'admin'])->except(['show']);
        Route::get('role',               [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('role/create',        [RoleController::class, 'create'])->name('admin.role.create');
        Route::get('role/{id}/edit',     [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::patch('role/{id}',        [RoleController::class, 'update'])->name('admin.role.update');
        Route::post('role',              [RoleController::class, 'store'])->name('admin.role.store');
        Route::post('admin/role/delete',  [RoleController::class, 'delete'])->name('admin.role.delete');
        Route::delete('role/{id}',        [RoleController::class, 'destroy'])->name('admin.role.destroy');

        Route::get('/permissions/{guard_name}', function ($guard_name) {
            return response()->json(Permission::where('guard_name', $guard_name)->get());
        });

        // ── Website Content Management ────────────────────────────────
        // Texts & media of each website section (hero, services intro, about, contact, …)
        Route::get('content/{group}',  [SettingController::class, 'edit'])->name('admin.setting.edit');
        Route::post('content/{group}', [SettingController::class, 'update'])->name('admin.setting.update');

        // Repeatable content: each one is a bilingual list with add / edit / delete
        Route::resource('slide',     HeroSlideController::class,     ['as' => 'admin'])->except(['show']);
        Route::resource('ticker',    TickerItemController::class,    ['as' => 'admin'])->except(['show']);
        Route::resource('service',   ServiceController::class,       ['as' => 'admin'])->except(['show']);
        Route::resource('portfolio', PortfolioItemController::class, ['as' => 'admin'])->except(['show']);
        Route::resource('logo',      ClientLogoController::class,    ['as' => 'admin'])->except(['show']);
        Route::resource('stat',      StatController::class,          ['as' => 'admin'])->except(['show']);
        Route::resource('location',  LocationController::class,      ['as' => 'admin'])->except(['show']);
        Route::resource('social',    SocialLinkController::class,    ['as' => 'admin'])->except(['show']);

        // ── Contact form submissions ──────────────────────────────────
        Route::get('message',          [ContactMessageController::class, 'index'])->name('admin.message.index');
        Route::get('message/{id}',     [ContactMessageController::class, 'show'])->name('admin.message.show');
        Route::delete('message/{id}',  [ContactMessageController::class, 'destroy'])->name('admin.message.destroy');
    });
});

// Login lives inside the locale group too, so the language switch works on the login page.
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
        Route::get('login',  [LoginController::class, 'show_login_view'])->name('admin.showlogin');
        Route::post('login', [LoginController::class, 'login'])->name('admin.login');
    });
});
