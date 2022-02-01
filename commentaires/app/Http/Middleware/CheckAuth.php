<?php

namespace App\Http\Middleware;

use Closure;
use Kreait\Firebase\Factory;
use Laravel\Lumen\Http\Request;

class CheckAuth
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $auth = (new Factory())->createAuth();
            $verifiedToken = $auth->verifyIdToken($request->bearerToken());
            $user = $auth->getUser($verifiedToken->claims()->get('sub'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
