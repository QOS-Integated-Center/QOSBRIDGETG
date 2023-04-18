<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Perform authentication logic here
        $token = $request->header('Authorization');
        if (!$token || !auth()->guard('api')->check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
    
        // Proceed with the request if authenticated
        return $next($request);
    }
    
}
