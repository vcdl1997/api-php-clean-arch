<?php

namespace App\Infrastructure\Configurations\Providers;

use App\Domain\Repositories\UsuarioRepository;
use App\Infrastructure\Repositories\Impl\UsuarioRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UsuarioRepository::class, UsuarioRepositoryImpl::class);
    }
}
