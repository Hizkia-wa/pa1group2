<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

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
});

