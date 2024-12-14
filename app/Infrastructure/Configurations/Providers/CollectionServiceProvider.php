<?php

namespace App\Infrastructure\Configurations\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Collection::macro('mapContentToArray', function () {
            /** @var Collection $this */
            return $this->map(fn($value) => (array)$value);
        });
    }
}
