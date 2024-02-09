<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    //'auth',
])
    ->prefix('agent')
    ->as('contract.')
    ->group(function (){
        Route::get('/contracts', [\App\Http\Controllers\ContractController::class, 'index'])
            ->name('index')
            ->withoutMiddleware('auth');

        Route::get('/contracts/{contract}', [\App\Http\Controllers\ContractController::class, 'show'])
            ->name('show')
            ->where('contract', '[0-9]+');

        Route::post('/contracts', [\App\Http\Controllers\ContractController::class, 'store'])->name('store');

        Route::patch('/contracts/{contract}', [\App\Http\Controllers\ContractController::class, 'update'])->name('update');

        Route::delete('/contracts/{contract}', [\App\Http\Controllers\ContractController::class, 'destroy'])->name('delete');
    });


