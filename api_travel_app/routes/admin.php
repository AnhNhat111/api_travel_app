<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;

Route::group(['prefix' => '/'], function () {
    
    Route::post('login', [AuthController::class, 'login']);

});