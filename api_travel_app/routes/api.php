<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ResetPasswordController;
use App\Http\Controllers\api_admin\TourController;
use App\Http\Controllers\api_admin\VehicleController;

use App\Http\Controllers\api\UserTourController;
use App\Http\Controllers\api_admin\ImagesController;
use App\Http\Controllers\api_admin\LocationController;

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

        Route::resource('user-tour', UserTourController::class);
    });
});
Route::post('active-code', [AuthController::class, 'ActiveUser']);
Route::post('forgot-password', [AuthController::class, 'forgotpassword']);

Route::resource('tour', TourController::class);
Route::resource('vehicle', VehicleController::class);
Route::resource('location', LocationController::class);
Route::resource('images', ImagesController::class);