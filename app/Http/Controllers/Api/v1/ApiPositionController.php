<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Traits\HasApiResponse;
use Illuminate\Http\JsonResponse;

class ApiPositionController extends Controller
{
    use HasApiResponse;

    public function index(): JsonResponse
    {
        return $this->success([
            'positions' => Position::all()
        ]);
    }
}
