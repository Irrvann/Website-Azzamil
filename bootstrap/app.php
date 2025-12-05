<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->web(append: [
        ]);
        $middleware->alias([
            'auth' => Authenticate::class,

            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
        $middleware->redirectUsersTo(function (Request $request) {
            $user = $request->user();

            if (!$user) {
                return '/'; // fallback aja, normalnya nggak kepakai
            }

            if ($user->hasRole('super_admin')) {
                return route('superadmin.dashboard');
            }

            if ($user->hasRole('admin')) {
                return route('admin.dashboard');
            }

            // fallback kalau role nggak dikenali
            return '/';
        });
    })


    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
