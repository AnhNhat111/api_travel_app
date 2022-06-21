<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;

Route::group(['prefix' => '/'], function () {
Route::get('/login', function () {
    return response()->json("hello");
});
});