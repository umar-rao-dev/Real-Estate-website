<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array<int, class-string>
     */
    protected $middleware = [
        // You can leave this empty or add global middleware if needed
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // Add web group middleware if needed (like sessions)
        ],

        'api' => [
            // Add api group middleware if needed (like throttle)
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'agent' => \App\Http\Middleware\AgentMiddleware::class,
        'role'  => \App\Http\Middleware\RoleMiddleware::class,
        'user'  => \App\Http\Middleware\UserMiddleware::class,
    ];
}
