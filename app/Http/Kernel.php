<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\PreventBackHistory;

class Kernel extends HttpKernel
{
    // The application's global HTTP middleware stack.
    protected $middleware = [
        // Global middleware
    ];

    // The application's route middleware.
    protected $routeMiddleware = [
        'prevent-back-history' => \App\Http\Middleware\PreventBackHistory::class,
    ];

    // Middleware groups for the 'web' and 'api' routes
    protected $middlewareGroups = [
        'web' => [
            // Web middleware
        ],
        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
}


