<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureClientIsAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('sanctum')->check() || $request->user() instanceof \App\Models\Client) {
            return response()->json(['message' => 'Unauthorized. Please log in as a client.'], 401);
        }

        return $next($request);
    }
}