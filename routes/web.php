<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cashier\CashierController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome')->name('welcome');

    Route::get('/cashier/login', [AuthController::class, 'showLogin'])->name('show.cashier.login');
    Route::post('/cashier/login', [AuthController::class, 'cashierLogin'])->name('cashier.login');

    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('show.admin.login');
    Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
});


Route::middleware(['auth', 'user_role:cashier'])->group(function () {
    Route::resource('cashier', CashierController::class);
});

Route::middleware(['auth', 'user_role:admin'])->group(function () {
    Route::resource('admin/dashboard', DashboardController::class);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');