<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\AdminLoginController;

Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the API'], 200);
});

//// Admin login routes
//Route::prefix('admin')->group(function () {
//    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
//    Route::post('/login', [AdminLoginController::class, 'login']);
//});
//
//// Admin panel routes
//Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
//    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
//    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
//});
