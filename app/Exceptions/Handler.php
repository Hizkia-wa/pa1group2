<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

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
            Log::error($e->getMessage());
        });
    }

    /**
     * Convert an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // Handle 404 Not Found
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.custom', [], 404);
        }

        // Handle 403 Forbidden
        if ($exception instanceof UnauthorizedHttpException || $exception instanceof AccessDeniedHttpException) {
            return response()->view('errors.custom', [], 403);
        }

        // Handle 500 Internal Server Error
        if ($exception instanceof Exception) {
            return response()->view('errors.custom', ['message' => 'Something went wrong!'], 500);
        }

        // For all other exceptions
        return parent::render($request, $exception);
    }
}
