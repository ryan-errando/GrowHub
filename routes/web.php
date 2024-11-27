<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ServiceController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'authenticate']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('register', [RegisterController::class, 'store']);

Route::get('home', [HomeController::class, 'index'])->name('user.home')->middleware('auth');

Route::get('products', [ProductController::class, 'index'])->name('user.product')->middleware('auth');
Route::get('products/search', [ProductController::class, 'search'])->name('user.product.search')->middleware('auth');

Route::get('services', [ServiceController::class, 'index'])->name('user.service')->middleware('auth');
Route::get('services/search', [ServiceController::class, 'search'])->name('user.service.search')->middleware('auth');