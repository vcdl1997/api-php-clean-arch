<?php

namespace App\Infrastructure\Configurations\Providers;

use App\Infrastructure\Configurations\Middlewares\EnableTransaction;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    const NAMESPACE_CONTROLLERS = 'App\Application\Controllers';

    public function boot(Router $router)
    {
        $router->middleware('api')->namespace(self::NAMESPACE_CONTROLLERS)->group(base_path('routes/api.php'));

        $router->aliasMiddleware('enableTransaction', EnableTransaction::class);
    }
}
