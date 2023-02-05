<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\client\OrderController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
// use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        // Route::group([], function(){

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', [WelcomeController::class, 'index'])->name('index');

            Route::resources([
                'users' => UserController::class,
                'categories' => CategoryController::class,
                'products' => ProductController::class,
                'clients' => ClientController::class,
            ]);

            Route::resource('clients.orders', OrderController::class)->except(['show']);
        });
    }
);
