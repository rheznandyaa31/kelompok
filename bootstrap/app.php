<?php

use App\Http\Middleware\AuthenticationMiddleware;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('api', [
            \App\Http\Middleware\CorsMiddleware::class,
                \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
                // 'throttle:api',
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        $middleware->alias([
            'authweb' => AuthenticationMiddleware::class,
            'role' => RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        return [
            'allowed_origins' => ['http://localhost', 'http://127.0.0.1'],
        ];
    })->create();
