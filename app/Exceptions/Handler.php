<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Exception $e) {
            // Bisa menambahkan log atau pengiriman email jika terjadi error tertentu
            Log::error($e->getMessage());
        });

        // Error handling untuk 404, 403, 500, dll
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            return response()->view('errors.custom', [], 404); // Halaman 404 custom
        });

        $this->renderable(function (UnauthorizedHttpException $e, Request $request) {
            return response()->view('errors.custom', [], 403); // Halaman 403 custom
        });

        $this->renderable(function (AccessDeniedHttpException $e, Request $request) {
            return response()->view('errors.custom', [], 403); // Halaman 403 custom
        });

        // Error umum untuk 500 dan lainnya
        $this->renderable(function (Exception $e, Request $request) {
            return response()->view('errors.custom', ['message' => 'Something went wrong!'], 500); // Halaman 500 custom
        });
    }
}
