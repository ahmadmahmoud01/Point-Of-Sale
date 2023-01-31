<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
// use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        // Route::group([], function(){

        Route::prefix('dashboard/')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('index', [DashboardController::class, 'index'])->name('index');

            Route::resources([
                'users' => UserController::class,
                'categories' => CategoryController::class,
                'products' => ProductController::class,
                'clients' => ClientController::class,
            ]);
        });
    }
);
