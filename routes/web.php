<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Produk
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{ProductID}/view', [ProductController::class, 'show'])->name('admin.products.view');
    Route::get('/products/{ProductID}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{ProductID}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{ProductID}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

});
