<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withCommands([
        \App\Console\Commands\AutoCompleteShippedOrders::class,
        \App\Console\Commands\AutoActivatePromos::class,
    ])
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('orders:auto-complete-shipped')
            ->dailyAt('08:00')
            ->withoutOverlapping();

        $schedule->command('promos:auto-activate')
            ->dailyAt('00:01')
            ->withoutOverlapping();
    })
    ->create();
