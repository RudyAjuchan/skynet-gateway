<?php

namespace App\Http\Middleware;

use Closure;

class RolMiddleware
{
    public function handle($request, Closure $next, $rolNombre)
    {
        
        if (!$request->user() || $request->user()->rol->nombre !== $rolNombre) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return $next($request);
    }
}
