<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Traits\API\V1\ApiResponse;


class Handler extends ExceptionHandler
{
    use ApiResponse;

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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // Handling JSON Error Responses
    public function render($request, Throwable $exception)
{
    if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
        return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
    }

    return parent::render($request, $exception);
}

}