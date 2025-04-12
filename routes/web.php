<?php

use Illuminate\Support\Facades\Route;

// Route untuk halaman dashboard admin
Route::get('Admin/homepage', function () {
    return view('admin.homepage');
})->name('admin.homepage');

