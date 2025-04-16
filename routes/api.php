<?php

use App\Http\Controllers\BedroomController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/bedroom', BedroomController::class);
Route::resource('/type', TypeController::class);
Route::resource('/order', OrderController::class);