<?php

namespace App\Exceptions\Api;

use App\Traits\HasApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserExistsException extends Exception
{
    use HasApiResponse;

    public function render(Request $request): JsonResponse
    {
        return $this->error(
            __('user.validation.exists'),
            status: Response::HTTP_CONFLICT
        );
    }
}
