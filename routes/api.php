<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\ReservationController;

Route::middleware(['auth:sanctum'])->name('api.')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('properties', PropertyController::class);
    Route::apiResource('reservations', ReservationController::class)->only(['index', 'store', 'show']);
});
