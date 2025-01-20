<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\TransactionController;

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

// Routes autentikasi
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

// Routes admin
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::prefix('tickets')->group(function () {
        Route::post('/', [TicketController::class, 'store']);
        Route::put('{ticket}', [TicketController::class, 'update']);
        Route::delete('{ticket}', [TicketController::class, 'destroy']);
        Route::get('export', [TicketController::class, 'export']);
    });

    Route::prefix('destinations')->group(function () {
        Route::post('/', [DestinationController::class, 'store']);
        Route::put('{destination}', [DestinationController::class, 'update']);
        Route::delete('{destination}', [DestinationController::class, 'destroy']);
        Route::get('export', [DestinationController::class, 'export']);
    });

    Route::prefix('facilities')->group(function () {
        Route::post('/', [FacilityController::class, 'store']);
        Route::put('{facility}', [FacilityController::class, 'update']);
        Route::delete('{facility}', [FacilityController::class, 'destroy']);
        Route::get('export', [FacilityController::class, 'export']);
    });

    Route::prefix('transactions')->group(function () {
        Route::get('export', [TransactionController::class, 'export']);
    });
});

// Routes user dan admin (read-only akses)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('tickets')->group(function () {
        Route::get('/', [TicketController::class, 'index']);
        Route::get('{ticket}', [TicketController::class, 'show']);
    });

    Route::prefix('destinations')->group(function () {
        Route::get('/', [DestinationController::class, 'index']);
        Route::get('{destination}', [DestinationController::class, 'show']);
    });

    Route::prefix('facilities')->group(function () {
        Route::get('/', [FacilityController::class, 'index']);
        Route::get('{facility}', [FacilityController::class, 'show']);
    });

    Route::prefix('transactions')->group(function () {
        Route::post('/', [TransactionController::class, 'store']);
        Route::get('/', [TransactionController::class, 'index']);
        Route::get('{transaction}', [TransactionController::class, 'show']);
        Route::put('{transaction}', [TransactionController::class, 'update']);
    });
});
