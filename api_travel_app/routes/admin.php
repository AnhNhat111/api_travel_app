<?php

use Illuminate\Support\Facades\Route;
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

    Route::group([
        // 'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
        Route::post('change-password', [ResetPasswordController::class, 'changePassword']);
        Route::post('change-infor', [ResetPasswordController::class, 'changeInformation']);
        Route::resource('vehicle', VehicleController::class);
        Route::resource('location', LocationController::class);
        Route::resource('images', ImagesController::class);
        Route::resource('booking-tour-admin', AdminBookingController::class);
        Route::get('statistical', [StatisticalController::class, 'statistical_tour']);

        Route::resource('tour', TourController::class);
        Route::resource('user', UserManagement::class);
    });
});