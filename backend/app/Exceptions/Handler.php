<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof TokenExpiredException) {
            return response()->json(['token_expired'], $exception->getStatusCode());
        } else if ($exception instanceof TokenInvalidException) {
            return response()->json(['token_invalid'], $exception->getStatusCode());
        } else if( $exception instanceof JWTException) {
            return response()->json(['error' => 'Error ferching'], $exception->getStatusCode());
        }

        return response()->json(
            [
                'errors' => [
                    'status' => 401,
                    'message' => 'Unauthenticated',
                ]
            ], 401
        );

        //return parent::render($request, $exception);
    }
}
