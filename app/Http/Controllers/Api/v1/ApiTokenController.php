<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\RegisterToken;
use App\Traits\HasApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{
    use HasApiResponse;

    public function __invoke(Request $request): JsonResponse
    {
        $token = Str::random(100);

        RegisterToken::where('token', $request->header('Token'))->delete();

        RegisterToken::create([
            'token' => $token,
            'expires_at' => now()->addMinutes(config('users.token.lifetime')),
        ]);

        return $this->success([
            'token' => $token
        ])->header('Cache-Control', 'no-cache');
    }
}
