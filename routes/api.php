<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

// Authentication routes
//Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/register', [AuthenticatedSessionController::class, 'register']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Orders
    Route::post('/orders', [OrderController::class, 'store']); // Create order
    Route::get('/orders', [OrderController::class, 'index']); // View user orders
    Route::get('/orders/{id}', [OrderController::class, 'show']);


    // Profile
    Route::get('/profile', [ProfileController::class, 'show']); // View profile
    Route::put('/profile', [ProfileController::class, 'update']); // Update profile
});
