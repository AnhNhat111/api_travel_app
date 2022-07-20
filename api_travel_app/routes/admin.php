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

    // Route::get('index', [LoginController::class, 'index'])->name('admin.index');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::group([
        'middleware' => 'auth:admin'
    ], function () {
        Route::get('/', function () {
            return redirect()->intended(route('admin.statiscal'));
        });

        Route::resource('tour', TourController::class);
        Route::resource('user', UserManagement::class);

        Route::resource('booking', AdminBookingController::class);
        Route::get('booking-confirmed', [AdminBookingController::class, 'booking_confirmed'])->name('admin.BookingConfirmed');
        Route::get('booking-not-confirmed', [AdminBookingController::class, 'booking_not_confirmed'])->name('admin.BookingNotConfirmed');

        Route::get('location', [LocationController::class, 'location'])->name('admin.location');
        Route::get('vehicle', [VehicleController::class, 'vehicle'])->name('admin.vehicle');
        Route::get('index', [StatisticalController::class, 'statistical_tour']);
        Route::get('hot-tour', [TourController::class, 'hot_tour']);
        Route::get('statistical_month', [StatisticalController::class, 'statistical_month'])->name('admin.statiscal');
    });
});