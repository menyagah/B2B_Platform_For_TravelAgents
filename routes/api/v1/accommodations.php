<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    //'auth',
])
    ->prefix('service')
    ->as('accommodation.')
    ->group(function (){
        Route::get('/accommodations', [\App\Http\Controllers\AccommodationController::class, 'index'])
            ->name('index')
            ->withoutMiddleware('auth');

        Route::get('/accommodations/{accommodation}', [\App\Http\Controllers\AccommodationController::class, 'show'])
            ->name('show')
            ->where('accommodation', '[0-9]+');

        Route::post('/accommodations', [\App\Http\Controllers\AccommodationController::class, 'store'])->name('store');

        Route::patch('/accommodations/{accommodation}', [\App\Http\Controllers\AccommodationController::class, 'update'])->name('update');

        Route::delete('/accommodations/{accommodation}', [\App\Http\Controllers\AccommodationController::class, 'destroy'])->name('delete');
    });


