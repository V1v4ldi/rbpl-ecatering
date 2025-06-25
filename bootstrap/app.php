<?php

use Illuminate\Foundation\Application;
use App\http\Middleware\CorsMiddleware;
use App\Exceptions\InvalidOrderException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
       $middleware->trustProxies(
            '**', // Parameter pertama adalah proxies itu sendiri
            Request::HEADER_X_FORWARDED_FOR |
            Request::HEADER_X_FORWARDED_HOST |
            Request::HEADER_X_FORWARDED_PORT |
            Request::HEADER_X_FORWARDED_PROTO |
            Request::HEADER_X_FORWARDED_AWS_ELB
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (\Exception $e) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                return redirect()->route('homepage');
            };
        });
    })->create();
