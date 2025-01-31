<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MethodCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $method): Response
    {
        if ($request->method() !== strtoupper($method)) {
            return response()->json([
                'message' => 'Method not allowed for this route.',
                'allowed_method' => strtoupper($method),
            ], 405);
        }
        return $next($request);
    }
}
