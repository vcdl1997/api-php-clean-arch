<?php

namespace App\Infrastructure\Configurations\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    const NAMESPACE_CONTROLLERS = 'App\Application\Controllers';

    public function boot()
    {
        Route::middleware('api')
            ->namespace(self::NAMESPACE_CONTROLLERS)
            ->group(base_path('routes/api.php'));
    }
}
