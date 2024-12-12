<?php

namespace App\Infrastructure\Configurations\Providers;

use App\Application\Controllers\Handlers\ControllerExceptionHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class ExceptionHandlerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ExceptionHandler::class, ControllerExceptionHandler::class);
    }
}
