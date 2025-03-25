<?php

namespace App\Http\Middleware;

use App\Models\RegisterToken;
use App\Traits\HasApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegisterToken
{
    use HasApiResponse;

    public function handle(Request $request, Closure $next): Response
    {
        $token = RegisterToken::where('token', $request->header('Token'));

        if (!$token->valid()->exists()) {
            $token->delete();

            return $this->error(
                'The token expired',
                [],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $next($request);
    }
}
