<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// TAMBAHKAN ini untuk pakai ErrorHandlerServiceProvider
use App\Providers\ErrorHandlerServiceProvider;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Kamu bisa tambahkan middleware di sini jika perlu
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Kalau kamu nanti mau override handler tertentu bisa di sini
    })
    // INI YANG PALING PENTING ⬇️
    ->withProviders([
        ErrorHandlerServiceProvider::class,
    ])
    ->create();
