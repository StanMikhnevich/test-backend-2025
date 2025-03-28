<?php

use App\Http\Middleware\CheckRegisterToken;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api/v1.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        apiPrefix: 'api/v1'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['token', CheckRegisterToken::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e) {
            if ($e->getPrevious() && in_array($e->getPrevious()->getModel(), array_keys(config('app.exceptions')))) {
                throw new (config('app.exceptions')[$e->getPrevious()->getModel()]);
            }
        });
    })->create();
