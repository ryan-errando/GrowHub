<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerServiceController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Seller\SellerProfileController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ServiceController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\OrderController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'authenticate']);

Route::get('register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('register', [RegisterController::class, 'store']);


Route::middleware('auth:web')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('user.home');

    Route::get('profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::patch('profile', [ProfileController::class, 'update'])->name('user.profile.update');

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


    Route::post('order/process', [OrderController::class, 'processOrder'])->name('user.processOrder');

    Route::get('order/success', function () {
        return view('user.orderSuccess');
    })->name('user.orderSuccess');

    Route::get('orderProducts', [OrderController::class, 'productOrders'])->name('user.orderProducts');
    Route::get('orderServices', [OrderController::class, 'serviceOrders'])->name('user.orderServices');
    Route::get('orderProducts/{order}', [OrderController::class, 'productOrderDetail'])->name('user.orderProductDetail');
    Route::get('orderServices/{order}', [OrderController::class, 'serviceOrderDetail'])->name('user.orderServiceDetail');

    Route::post('user/logout', [AuthController::class, 'logout'])->name('user.logout');
});

Route::middleware('auth:seller')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('seller.dashboard');

    Route::get('addProducts/create', [SellerProductController::class, 'create'])->name('sellerProducts.create');
    Route::post('addProducts', [SellerProductController::class, 'store'])->name('sellerProducts.store');

    Route::get('products/{product}/edit', [SellerProductController::class, 'edit'])->name('sellerProducts.edit');
    Route::put('products/{product}', [SellerProductController::class, 'update'])->name('sellerProducts.update');
    Route::delete('products/{product}', [SellerProductController::class, 'destroy'])->name('sellerProducts.destroy');

    Route::get('addServices/create', [SellerServiceController::class, 'create'])->name('sellerServices.create');
    Route::post('addServices', [SellerServiceController::class, 'store'])->name('sellerServices.store');

    Route::get('services/{service}/edit', [SellerServiceController::class, 'edit'])->name('sellerServices.edit');
    Route::put('services/{service}', [SellerServiceController::class, 'update'])->name('sellerServices.update');
    Route::delete('services/{service}', [SellerServiceController::class, 'destroy'])->name('sellerServices.destroy');

    Route::get('sellerOrderProduct', [SellerOrderController::class, 'sellerProductOrders'])->name('seller.OrderProduct');
    Route::get('sellerOrderService', [SellerOrderController::class, 'sellerServiceOrders'])->name('seller.OrderService');
    Route::put('seller/orders/product/{order}/status', [SellerOrderController::class, 'updateProductOrderStatus'])->name('seller.updateProductOrderStatus');
    Route::put('seller/orders/service/{order}/status', [SellerOrderController::class, 'updateServiceOrderStatus'])->name('seller.updateServiceOrderStatus');

    Route::get('sellerOrderProduct/{order}', [SellerOrderController::class, 'productOrderDetail'])->name('seller.orderProductDetail');
    Route::get('sellerOrderService/{order}', [SellerOrderController::class, 'serviceOrderDetail'])->name('seller.orderServiceDetail');

    Route::get('/seller/profile', [SellerProfileController::class, 'index'])->name('seller.profile');
    Route::put('/seller/profile/update', [SellerProfileController::class, 'update'])->name('seller.profile.update');

    Route::post('seller/logout', [AuthController::class, 'logout'])->name('seller.logout');
});
