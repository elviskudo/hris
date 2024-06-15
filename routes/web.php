<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers');
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/users', [UserController::class, 'index'])->name('users');
