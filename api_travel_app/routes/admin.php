<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api_admin\AdminAuthController;

Route::group([
    'prefix' => '/'
], function () {

    Route::post('login', [AdminAuthController::class, 'login']);

    Route::group([
        'middleware' => 'auth:admin'
    ], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
        Route::post('change-password', [ResetPasswordController::class, 'changePassword']);
        Route::post('change-infor', [ResetPasswordController::class, 'changeInformation']);
        Route::apiResource('booking-tour', UserBookingController::class);
        Route::resource('user-tour', UserTourController::class);
     
        Route::get('user-location', [UserTourController::class, 'get_location']);
        Route::get('user-location-tour/{id}', [UserTourController::class, 'get_tour_in_location']);
        Route::get('by_tour/{id}', [UserTourController::class, 'get_tour_by_id']);
    });
});