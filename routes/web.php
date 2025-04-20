<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\users\UloskitaController; 
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\CustomLoginController;


// Route untuk halaman dashboard admin
Route::get('Admin/homepage', function () {
    return view('admin.homepage');
})->name('admin.homepage');

Route::prefix('Admin')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/product/detail/{id}', [ProductController::class, 'showDetail'])->name('product.detail');
    Route::get('/products/riwayat', [ProductController::class, 'riwayat'])->name('products.riwayat');
    Route::put('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::get('/products/bestproducts', [ProductController::class, 'bestProducts'])->name('products.best');
    Route::get('/products/bestproducts/create', [ProductController::class, 'createBestProduct'])->name('products.best.create');
    Route::get('/bestproducts/{id}/edit', [ProductController::class, 'edit'])->name('bestproducts.edit');
    Route::put('/bestproducts/{id}', [ProductController::class, 'update'])->name('bestproducts.update');
    Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('admin.changePasswordForm');
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/reviews', [ReviewController::class, 'adminIndex'])->name('admin.reviews');
    Route::delete('/reviews/{id}/hide', [ReviewController::class, 'destroy'])->name('admin.reviews.hide');
    Route::get('/riwayat-ulasan', [ReviewController::class, 'trashed'])->name('admin.reviews.trashed');
    Route::post('/riwayat-ulasan/{id}/restore', [ReviewController::class, 'restore'])->name('admin.reviews.restore');
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/orders/selesai', [OrderController::class, 'selesai'])->name('admin.orders.selesai');
    Route::get('/orders/batal', [OrderController::class, 'ordersBatal'])->name('admin.orders.batal');
});

Route::prefix('user')->group(function () {
    Route::get('/reviews', [ReviewController::class, 'index'])->name('user.reviews');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('user.reviews.store');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('user.reviews.destroy');
    Route::post('/produk/order', [OrderController::class, 'store'])->name('user.product.order');
    Route::get('/admin/orders/riwayat', [OrderController::class, 'riwayat'])->name('orders.riwayat');
    Route::get('/produk', [ProductController::class, 'showUserCatalog'])->name('user.product.catalog');
    Route::get('/produk/{id}', [ProductController::class, 'showUserDetail'])->name('user.product.detail');
    Route::get('/keranjang', [CartController::class, 'index'])->name('user.cart.index');
    Route::post('/keranjang/tambah', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::post('/keranjang/hapus/{id}', [CartController::class, 'removeFromCart'])->name('user.cart.remove');
    Route::post('/keranjang/checkout', [CartController::class, 'checkout'])->name('user.cart.checkout');
    Route::put('/keranjang/update/{id}/{size}', [CartController::class, 'updateQuantity'])->name('user.cart.update');
});

Route::get('/profilumkm', function () {
    return view('users.profilumkm');
})->name('profil.umkm');

Route::get('/uloskita', [UloskitaController::class, 'index'])->name('uloskita');

// Route untuk halaman detail ulos
Route::get('/ulos-kita/detail/{jenis}', [UloskitaController::class, 'detail'])->name('uloskita.detail');

Route::get('/register', [CustomLoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [CustomLoginController::class, 'register'])->name('register.submit');
// Route untuk halaman login
Route::get('/login/custom', [CustomLoginController::class, 'showLoginForm'])->name('login.custom');

// Route untuk proses login (POST)
Route::post('/login/custom', [CustomLoginController::class, 'login'])->name('login.custom.submit');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');