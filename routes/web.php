<?php

use App\Http\Controllers\Admin\BinController as AdminBinController;
use App\Http\Controllers\Admin\CashierController as AdminCashierController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InventoryController as AdminInventoryController;
use App\Http\Controllers\Cashier\CashierController as CashierCashierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::view('/test', 'test');

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome')->name('welcome');

    Route::get('cashier/login', [AuthController::class, 'showLogin'])->name('show.cashier.login');
    Route::post('cashier/login', [AuthController::class, 'cashierLogin'])->name('cashier.login');

    Route::get('admin/login', [AuthController::class, 'showLogin'])->name('show.admin.login');
    Route::post('admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
});


Route::middleware(['auth', 'user_role:cashier'])->group(function () {
    Route::resource('cashier', CashierCashierController::class);
});

Route::middleware(['auth', 'user_role:admin'])->group(function () {
    // resources
    Route::resource('admin/dashboard', AdminDashboardController::class)->only(['index']);
    Route::resource('admin/inventory', AdminInventoryController::class)->except(['create', 'show', 'edit']);
    Route::resource('admin/inventory/bin', AdminBinController::class)->only(['index']);
    Route::resource('admin/cashiers', AdminCashierController::class);

    // patch-update-some
    Route::patch('admin/inventory/bin/{id}/restore', [AdminBinController::class, 'restore'])->name('bin.restore');
});

Route::view('forbidden', 'forbidden')->name('forbidden');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');