<?php

use App\Http\Controllers\Admin\CashierController as AdminCashierController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cashier\CashierController as CashierCashierController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::view('/test', 'test');

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome')->name('welcome');

    Route::get('/cashier/login', [AuthController::class, 'showLogin'])->name('show.cashier.login');
    Route::post('/cashier/login', [AuthController::class, 'cashierLogin'])->name('cashier.login');

    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('show.admin.login');
    Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
});


Route::middleware(['auth', 'user_role:cashier'])->group(function () {
    Route::resource('cashier', CashierCashierController::class);
});

Route::middleware(['auth', 'user_role:admin'])->group(function () {
    Route::resource('admin/dashboard', DashboardController::class);

    Route::resource('admin/inventory', InventoryController::class);
    Route::patch('/admin/inventory/{id}/restore', [InventoryController::class, 'restore'])->name('inventory.restore');

    Route::resource('admin/cashiers', AdminCashierController::class);
});

Route::view('/forbidden', 'forbidden')->name('forbidden');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');