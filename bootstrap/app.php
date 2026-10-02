<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function(){
           Route::group([],base_path('routes/testing.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias(['isValidUser'=>ValidUser::class]);
        //$middleware->appendToGroup('ok-user',[ValidUser::class]); // append 2,3,4... middleware here
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
