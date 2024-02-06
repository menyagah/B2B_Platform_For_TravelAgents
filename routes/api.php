<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::apiResource('users', \App\Http\Controllers\UserController::class);

Route::prefix('v1')
    ->group(function (){

        require __DIR__ . '/api/v1/users.php';
        require  __DIR__ . '/api/v1/accommodations.php';
        require __DIR__ . '/api/v1/bookings.php';
        require __DIR__ . '/api/v1/contracts.php';
    });



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
