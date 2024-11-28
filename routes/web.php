<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ServiceController;
use App\Http\Controllers\User\CartController;

Route::get('/', function () {return redirect('/login');});

Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'authenticate']);

Route::get('register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('register', [RegisterController::class, 'store']);


Route::middleware('auth:web')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('user.home');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    Route::get('products', [ProductController::class, 'index'])->name('user.product');
    Route::get('products/search', [ProductController::class, 'search'])->name('user.product.search');
    Route::get('products/{id}', [ProductController::class, 'detail'])->name('user.product.detail');

    Route::get('services', [ServiceController::class, 'index'])->name('user.service');
    Route::get('services/search', [ServiceController::class, 'search'])->name('user.service.search');
    Route::get('services/{id}', [ServiceController::class, 'detail'])->name('user.service.detail');

    Route::get('cart', [CartController::class, 'index'])->name('user.cart');
    Route::post('cart/add', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::patch('cart/{type}/{id}', [CartController::class, 'updateQuantity'])->name('user.cart.update');
    Route::delete('cart/{type}/{id}', [CartController::class, 'removeItem'])->name('user.cart.remove');
});

Route::middleware('auth:seller')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
});