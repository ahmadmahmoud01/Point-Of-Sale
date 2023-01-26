<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use Mcamara\LaravelLocalization\LaravelLocalization;
// use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
// Route::group(function(){

    Route::prefix('/dashboard')->middleware(['auth'])->name('dashboard.')->group(function(){

        Route::get('/index', [DashboardController::class, 'index'])->name('.index');

        Route::resource('/users', UserController::class)->except('show');

        // Route::post('/users/update', [UserController::class, 'update'])->name('users.update');


        // Users
        // Route::resource('users', 'UserController')->except(['show']);
    });
});

