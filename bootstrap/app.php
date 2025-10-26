<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'rol' => \App\Http\Middleware\RolMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            
            // 1. Verificación robusta de si es una solicitud API.
            //    Comprueba si la solicitud 'Quiere JSON' (típico de APIs)
            if ($request->expectsJson()) {
                
                // 2. Si es API y la autenticación falla, devuelve JSON 401.
                return response()->json([
                    'message' => 'Unauthenticated (Token missing or invalid).',
                ], 401);
            }
        });
    })->create();
