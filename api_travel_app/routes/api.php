<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\UserBookingController;
use App\Http\Controllers\api\ResetPasswordController;
use App\Http\Controllers\api_admin\TourController;
use App\Http\Controllers\api_admin\VehicleController;

use App\Http\Controllers\api\UserTourController;
use App\Http\Controllers\api_admin\AdminBookingController;
use App\Http\Controllers\api_admin\ImagesController;
use App\Http\Controllers\api_admin\LocationController;
use App\Http\Controllers\api_admin\StatisticalController;
use App\Http\Controllers\api_admin\UserManagement;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([
    'prefix' => 'auth'
], function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('social-netwoking', [AuthController::class, 'socialnetwoking']);
    Route::post('login', [AuthController::class, 'login']);



    Route::group([
         'middleware' => 'auth:api'
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
        Route::resource('get-all-user', UserManagement::class);

        Route::post('active-code', [AuthController::class, 'ActiveUser']);
        Route::post('forgot-password', [AuthController::class, 'forgotpassword']);
        Route::resource('vehicle', VehicleController::class);
        Route::resource('location', LocationController::class);
        Route::resource('images', ImagesController::class);
        Route::resource('tour', TourController::class);
        Route::resource('booking-tour-admin', AdminBookingController::class);
        Route::get('statistical', [StatisticalController::class, 'statistical_tour']);
    });
});