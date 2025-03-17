<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SlotController;
use App\Http\Controllers\Api\AppoinmentController;

Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'doctors'], function () {
        Route::post('/availability', [SlotController::class, 'availability']);
        Route::get('/{id}/availability', [SlotController::class, 'slots']);
    });

    Route::group(['prefix' => 'appointments'], function () {
        Route::post('/book', [AppoinmentController::class, 'bookAppointment']);
        Route::get('/patient/{id}', [AppoinmentController::class, 'patient']);
        Route::get('/doctor/{id}', [AppoinmentController::class, 'doctor']);
    });
});
