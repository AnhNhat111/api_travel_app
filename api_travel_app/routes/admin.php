<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api_admin\LoginController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api_admin\AdminBookingController;
use App\Http\Controllers\api_admin\LocationController;
use App\Http\Controllers\api_admin\StatisticalController;
use App\Http\Controllers\api_admin\TourController;
use App\Http\Controllers\api_admin\UserManagement;
use App\Http\Controllers\api_admin\VehicleController;

Route::group([
    'prefix' => '/'
], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');

    Route::get('index', [LoginController::class, 'index'])->name('admin.index');
    Route::get('logout', [LoginController::class, 'dangxuat'])->name('admin.logout');


    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);

        Route::resource('vehicle', VehicleController::class);
        Route::resource('location', LocationController::class);

        Route::resource('booking-tour-admin', AdminBookingController::class);
        Route::get('statistical', [StatisticalController::class, 'statistical_tour']);

        Route::resource('tour', TourController::class);
        Route::resource('user', UserManagement::class);
    });
});