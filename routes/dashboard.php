<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\CategoryController;
// use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\client\OrderController;
use App\Http\Controllers\Dashboard\OrderController as DashboardOrderController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
// use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        // Route::group([], function(){

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

            Route::resources([
                'users' => UserController::class,
                'categories' => CategoryController::class,
                'products' => ProductController::class,
                'clients' => ClientController::class,
                'orders' => App\Http\Controllers\Dashboard\OrderController::class,
            ]);

            Route::resource('clients.orders', OrderController::class)->except(['show']);

            Route::get('/orders/{order}/products',
            [App\Http\Controllers\Dashboard\OrderController::class, 'products'])->name('orders.products');
        });
    }
);
