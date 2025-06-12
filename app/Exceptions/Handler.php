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
    public function render($request, Throwable $exception)
    {
        // Log error untuk melacak apakah error masuk ke sini
        Log::info('Error triggered: ' . get_class($exception));

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
