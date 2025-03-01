<?php

use App\Http\Controllers\Admin\BinProductController as AdminBinProductController;
use App\Http\Controllers\Admin\CashierController as AdminCashierController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InventoryController as AdminInventoryController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Cashier\CashierController as CashierCashierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Request;
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
    Route::resource('product', ProductController::class);

    Route::post('/cashier/purchase', [CashierCashierController::class, 'store'])->name('cashier.purchase.store');
});


Route::middleware(['auth', 'user_role:admin'])->group(function () {
    // resources
    Route::resource('admin/dashboard', AdminDashboardController::class)->only(['index']);
    Route::resource('admin/inventory', AdminInventoryController::class)->except(['create', 'show', 'edit']);
    Route::resource('admin/inventory/bin', AdminBinProductController::class)->only(['index']);
    Route::resource('admin/category', AdminCategoryController::class);
    Route::resource('admin/cashiers', AdminCashierController::class);

    // patch
    Route::patch('admin/inventory/bin/{id}/restore', [AdminBinProductController::class, 'restore'])->name('bin.restore');
    Route::patch('admin/inventory/bin/{id}/forceDelete', [AdminBinProductController::class, 'forceDelete'])->name('bin.forceDelete');
});

Route::view('forbidden', 'forbidden')->name('forbidden');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');