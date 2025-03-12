<?php

namespace App\Http\Middleware;

use App\Models\RegisterToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegisterToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = RegisterToken::where('token', $request->header('Token'));

        if (!$token->valid()->exists()) {
            $token->delete();

            return response()->json([
                'success' => false,
                'message' => 'Token not exist'
            ]);
        }

        return $next($request);
    }
}
