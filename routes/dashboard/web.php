<?php

use Illuminate\Support\Facades\Route;
// use Mcamara\LaravelLocalization\LaravelLocalization;
use App\Http\Controllers\Dashboard\DashboardController;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
    Route::prefix('/dashboard')->name('dashboard.')->group(function(){
        Route::get('/index', [DashboardController::class, 'index'])->name('index');
    });
});

