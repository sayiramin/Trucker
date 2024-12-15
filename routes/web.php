<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\OrderController;

// Default home route
Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the API'], 200);
});

// Admin Login Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);
});

// Admin Panel Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Logout route
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Orders routes
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');
    Route::post('/orders/{order}/send-message', [OrderController::class, 'sendMessage'])->name('admin.orders.send-message');
});

// Redirect '/' for authenticated admin users to the dashboard
Route::middleware(['auth', 'is_admin'])->get('/admin', function () {
    return redirect()->route('admin.dashboard');
});
