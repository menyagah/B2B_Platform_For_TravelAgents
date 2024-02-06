<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    //'auth',
])
    ->prefix('agent')
    ->as('booking.')
    ->group(function (){
        Route::get('/bookings', [\App\Http\Controllers\BookingController::class, 'index'])
            ->name('index')
            ->withoutMiddleware('auth');

        Route::get('/bookings/{booking}', [\App\Http\Controllers\BookingController::class, 'show'])
            ->name('show')
            ->where('booking', '[0-9]+');

        Route::post('/bookings', [\App\Http\Controllers\BookingController::class, 'store'])->name('store');

        Route::patch('/bookings/{booking}', [\App\Http\Controllers\BookingController::class, 'update'])->name('update');

        Route::delete('/bookings/{booking}', [\App\Http\Controllers\BookingController::class, 'destroy'])->name('delete');
    });

