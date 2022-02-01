<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Lumen\Http\Request;
use Auth;

class CheckAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() === null) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
