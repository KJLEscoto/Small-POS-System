<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome')->name('welcome');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('show.cashier.login');

    Route::post('/login', [AuthController::class, 'login'])->name('cashier.login');

    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('show.admin.login');
});


Route::middleware('auth')->group(function () {
    Route::view('/home', 'home')->name('home');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});