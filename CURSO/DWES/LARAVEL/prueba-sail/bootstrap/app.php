<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\FirstMiddleware;
use App\Http\Middleware\SecondMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        /*$middleware->web(append: FirstMiddleware::class);
        $middleware->web(append: SecondMiddleware::class);*/

        $middleware->alias([
            'first' => FirstMiddleware::class,
            'second' => SecondMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
    })->create();
