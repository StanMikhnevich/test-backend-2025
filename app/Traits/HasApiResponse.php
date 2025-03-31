<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HasApiResponse
{
    protected function success(array $data = [], int $status = 200): JsonResponse
    {
        return response()->json(array_merge(
            ['success' => true],
            $data
        ), $status);
    }

    protected function error(string $message, array $errors = [], int $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'fails' => $errors
        ], $status);
    }
}
