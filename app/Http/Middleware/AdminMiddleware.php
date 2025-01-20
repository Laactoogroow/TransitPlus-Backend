<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role_id !== 1) {
            return response()->json(['message' => 'Forbidden: Only admins can access this route'], 403);
        }

        return $next($request);
    }
}
