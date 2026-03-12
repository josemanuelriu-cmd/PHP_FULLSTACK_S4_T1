<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        // Manejo específico del error 404
        if ($exception instanceof NotFoundHttpException) {

            // Si es API
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Recurso no encontrado'
                ], 404);
            }

            // Si es web
            return response()->view('errors.404', [], 404);
        }

        return parent::render($request, $exception);
    }
}