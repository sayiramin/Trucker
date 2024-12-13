<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

// Authentication routes
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Orders
    Route::post('/orders', [OrderController::class, 'store']); // Create order
    Route::get('/orders', [OrderController::class, 'index']); // View user orders
    Route::get('/orders/{id}', [OrderController::class, 'show']); //View single order


    // Profile
    Route::get('/profile', [ProfileController::class, 'show']); // View profile
    Route::put('/profile', [ProfileController::class, 'update']); // Update profile
});

Route::get('/test-token', function () {
    $user = \App\Models\User::first(); // Fetch a user
    if (!$user) {
        return response()->json(['error' => 'No users found.'], 404);
    }

    if (!method_exists($user, 'createToken')) {
        return response()->json(['error' => 'createToken method is not available.'], 500);
    }

    $token = $user->createToken('Test Token')->plainTextToken;
    return response()->json(['token' => $token]);
});

