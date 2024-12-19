<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthenticated',
                        'error' => 'Please login to access this resource'
                    ], 401);
                }

                if ($e instanceof ValidationException) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Validation failed',
                        'errors' => $e->validator->getMessageBag()
                    ], 422);
                }

                if ($e instanceof ModelNotFoundException) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Resource not found',
                        'error' => 'The requested resource could not be found'
                    ], 404);
                }

                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Route not found',
                        'error' => 'The requested route does not exist'
                    ], 404);
                }

                if ($e instanceof AuthorizationException) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthorized',
                        'error' => 'You are not authorized to perform this action'
                    ], 403);
                }

                if ($e instanceof MethodNotAllowedHttpException) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Method not allowed',
                        'error' => 'The requested method is not supported for this route'
                    ], 405);
                }

                // Handle any other exceptions
                return response()->json([
                    'status' => false,
                    'message' => 'Server Error',
                    'error' => $e->getMessage()
                ], 500);
            }
        });
    }
}
