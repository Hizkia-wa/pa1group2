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
use App\Http\Controllers\HomeController;

// Halaman guest
Route::get('/', [HomeController::class, 'homeGuest'])->name('homeGuest');
Route::middleware('auth:customer')->get('/customer/home', [HomeController::class, 'homeCustomer'])->name('homeCustomer');

// Route untuk halaman dashboard admin (middleware auth:admin)
Route::middleware('auth:admin')->get('/Admin/homepage', [AdminController::class, 'dashboard'])->name('admin.homepage');

// ==================== Admin Routes ====================
Route::prefix('Admin')->middleware('auth:admin')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store-regular', [ProductController::class, 'storeRegular'])->name('products.storeRegular');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/product/detail/{id}', [ProductController::class, 'showDetail'])->name('product.detail');
    Route::get('/products/riwayat', [ProductController::class, 'riwayat'])->name('products.riwayat');
    Route::put('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::get('/products/bestproducts', [ProductController::class, 'bestProducts'])->name('products.best');
    Route::get('/products/bestproducts/create', [ProductController::class, 'createBestSeller'])->name('products.best.create');
    Route::post('/products/bestproducts', [ProductController::class, 'store'])->name('products.best.store');
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
    Route::get('/orders/detail/{id}', [OrderController::class, 'detail'])->name('admin.orders.detail');    
    Route::get('/homeuser', [HomeController::class, 'homeAdmin'])->name('homeAdmin');
    Route::get('/ulos-kita', [UloskitaController::class, 'indexadmin'])->name('admin.uloskita');
    Route::get('/catalog', [ProductController::class, 'showAdminCatalog'])->name('admin.catalog');
    Route::get('/profilumkm', function () {
        return view('admin.users.profilumkm');
    })->name('adminprofil.umkm');
    Route::get('/admin/reviews', [ReviewController::class, 'indexadmin'])->name('adminuser.reviews');
});

// ==================== User Routes ====================
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
    Route::put('/keranjang/update/{id}', [CartController::class, 'updateQuantity'])->name('user.cart.update');
    Route::get('/best-products', [ProductController::class, 'showUserBestSellers'])->name('user.bestproductpage');
});

// ==================== Customer Routes ====================
Route::prefix('customer')->middleware('auth:customer')->group(function () {
    Route::get('/ulos-kita', [UloskitaController::class, 'indexcustomer'])->name('customer.uloskita');
    Route::get('/catalog', [ProductController::class, 'showCustomerCatalog'])->name('customer.catalog');
    Route::get('/produk/{id}', [ProductController::class, 'showCustomerDetail'])->name('customer.product.detail');
    Route::get('/profilumkm', function () {
        return view('customer.profilumkm');
    })->name('customerprofil.umkm');
    Route::get('/reviews', [ReviewController::class, 'indexcustomer'])->name('customer.reviews');

    // ==================== Cart Routes ====================
    Route::get('/cart', [CartController::class, 'index'])->name('customer.cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('customer.cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('customer.cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('customer.cart.checkout');
    Route::post('/cart/process-checkout', [CartController::class, 'processCheckout'])->name('customer.cart.processCheckout');
    Route::post('/cart/update-quantity/{id}', [CartController::class, 'updateQuantity'])->name('customer.cart.updateQuantity');
    Route::get('/best-products', [ProductController::class, 'showCustomerBestSellers'])->name('customer.bestproductpage');
});

// ==================== Public Routes ====================
Route::get('/profilumkm', function () {
    return view('users.profilumkm');
})->name('profil.umkm');

Route::get('/uloskita', [UloskitaController::class, 'index'])->name('uloskita');

// Route untuk halaman detail ulos
Route::get('/ulos-kita/detail/{jenis}', [UloskitaController::class, 'detail'])->name('uloskita.detail');

// ==================== Authentication Routes ====================
Route::get('/register', [CustomLoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [CustomLoginController::class, 'register'])->name('register.submit');
Route::get('/login/custom', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/custom', [CustomLoginController::class, 'login'])->name('login.custom.submit');
Route::get('/lupa-password', [CustomLoginController::class, 'showForgotPasswordForm'])->name('forgot.password');
Route::post('/lupa-password', [CustomLoginController::class, 'handleForgotPassword'])->name('forgot.password.send');
Route::get('/verifikasi-otp', [CustomLoginController::class, 'showOTPForm'])->name('otp.form');
Route::post('/verifikasi-otp', [CustomLoginController::class, 'verifyOTP'])->name('otp.verify');
Route::get('/reset-password-baru', [CustomLoginController::class, 'showResetPasswordForm'])->name('reset.password.form');
Route::post('/reset-password-baru', [CustomLoginController::class, 'submitNewPassword'])->name('reset.password.submit');

Route::get('/test-layout', function () {
    return view('layouts.Admin');
});