<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\ExceptionRenderer;
use Throwable;

class ErrorHandlerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ExceptionRenderer::class, function () {
            return new class implements ExceptionRenderer {
                public function render(Throwable $e, $request)
                {
                    $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
                    $message = $e->getMessage() ?: 'Terjadi kesalahan.';

                    return response()->view('errors.general', [
                        'code' => $status,
                        'message' => $message,
                    ], $status);
                }
            };
        });
    }
}
