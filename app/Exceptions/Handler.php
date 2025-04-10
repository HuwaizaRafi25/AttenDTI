<?php

namespace App\Exceptions;

use Throwable;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof UnauthorizedException) {
            return response()->view(
                'errors.unauthorized',
                ['exception' => $e->getMessage()],
                403
            );
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->view('errors.view_not_found', [
                'message' => 'The page you are looking for could not be found.',
            ], 404);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->view('errors.method_not_allowed', [
                'message' => 'The method used is not allowed for this route.',
            ], 405);
        }

        if ($e instanceof \Illuminate\Http\Exceptions\HttpResponseException) {
            return response()->view('errors.server_error', [
                'message' => 'Oops! Something went wrong on our server.',
            ], 500);
        }

        return parent::render($request, $e);
    }
}
