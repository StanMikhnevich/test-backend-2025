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
}
