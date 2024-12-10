<?php

namespace App\Infrastructure\Configurations\Providers;

use App\Domain\Repositories\UsuarioRepository;
use App\Infrastructure\Repositories\UsuarioRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UsuarioRepository::class, UsuarioRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
