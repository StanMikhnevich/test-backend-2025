<?php

namespace App\Exceptions\Api;

use App\Traits\HasApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserNotFoundException extends Exception
{
    use HasApiResponse;

    public function render(Request $request): JsonResponse
    {
        return $this->error(
            'User not found',
            status: Response::HTTP_NOT_FOUND
        );
    }
}
