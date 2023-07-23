<?php

namespace App\Exceptions;

use App\Http\Response\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
        if ($request->wantsJson()) {
            // custom response

            \Log::error('Error!', [json_encode($e)]);
            if ($e instanceof ValidationException) {
                return ApiResponse::rejection($e->validator);
            }

            return ApiResponse::error($e->getMessage(), [], $e->getCode() ?? 400);
        }

        return parent::render($request, $e);
    }
}
