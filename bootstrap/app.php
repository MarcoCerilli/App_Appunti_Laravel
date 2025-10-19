<?php

use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //Registrazione degli ALIAS dei Middleware

        $middleware->alias([
            'admin' => EnsureUserIsAdmin::class,
        ]);
        
         // Puoi anche usare $middleware->append() o $middleware->prepend()
        // per aggiungere middleware a gruppi specifici (es. 'web', 'api') qui,
        // ma l'uso di alias è il metodo preferito per le rotte.


    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
