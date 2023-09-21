<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Api\Auth\AuthenticateController;
use App\Http\Controllers\Api\Customer\CustomerScheduleController;
use App\Http\Controllers\Api\Customer\CustomerVentureController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\UserContoller;
use App\Http\Controllers\Api\VentureController;
use App\Http\Controllers\Api\VenturePlotController;
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

Route::post('login', [AuthenticateController::class, 'login']);
Route::post('register', [RegisteredUserController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthenticateController::class, 'user']);
    Route::post('/logout', [AuthenticateController::class, 'logout']);
    // Admin
    Route::prefix('admin')->middleware('admin')->group(function () {
        // Route::apiResource('staffs', StaffController::class);
        // Route::apiResource('customers', CustomerController::class);
        Route::apiResource('users', UserContoller::class);
        Route::apiResource('ventures', VentureController::class);
        Route::apiResource('venture-plots', VenturePlotController::class);
    });
    // Customer
    Route::prefix('customer')->middleware('customer')->group(function () {
        Route::get('all-ventures', [CustomerVentureController::class, 'allVentureItems'])->name('all-ventures');
        Route::get('venture-details/{id}', [CustomerVentureController::class, 'ventureDetialById'])->name('venture-details');
        Route::apiResource('schedules', CustomerScheduleController::class);
    });
});
