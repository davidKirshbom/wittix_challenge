<?php

use App\Actions\CreateUser;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
        $middleware->web(append: [

            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,

        ]);
        $middleware->api(append: [

            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        $exceptions->render(function (HttpException $e, HttpRequest $request) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        });
    })->withCommands([CreateUser::class])->create();
