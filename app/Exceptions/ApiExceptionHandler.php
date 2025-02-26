<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Throwable;
use Illuminate\Validation\ValidationException;

class ApiExceptionHandler
{
    public function handle(Throwable $exception): JsonResponse
    {
        $statusCode = $this->getStatusCode($exception);

        $response = [
            'error' => [
                'code' => $statusCode,
                'message' => $exception->getMessage(),
            ],
        ];

        if ($exception instanceof ValidationException) {
            $response['error']['details'] = $exception->errors();
        }

        if (config('app.debug')) {
            $response['debug'] = [
                'exception' => $exception::class,
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
            ];
        }

        return response()->json($response, $statusCode);
    }

    protected function getStatusCode(Throwable $exception): int
    {
        if (method_exists($exception, 'getStatusCode')) {
            return $exception->getStatusCode();
        }

        return 500;
    }
}
