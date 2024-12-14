<?php

namespace App\Infrastructure\Configurations\Middlewares;

use Closure;
use Illuminate\Support\Facades\DB;

class EnableTransaction
{
    public function handle($request, Closure $next)
    {
        return DB::transaction(function () use ($request, $next) {
            return $next($request);
        });
    }
}

