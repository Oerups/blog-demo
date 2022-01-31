<?php

namespace App\Http\Middleware;

use Laravel\Lumen\Http\Request;
use Kreait\Firebase;

class CheckAuth
{
    public function handle(Request $request, \Closure $next)
    {
        try {
            $auth = (new Firebase\Factory())->createAuth();
            $verifiedToken = $auth->verifyIdToken($request->bearerToken());
            $user = $auth->getUser($verifiedToken->claims()->get('sub'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
