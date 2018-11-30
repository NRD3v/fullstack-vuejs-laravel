<?php

namespace Medoucine\City\App\Laravel;

use Medoucine\City\Domain\CityRepository;
use Medoucine\City\Domain\ICityRepository;
use Illuminate\Support\ServiceProvider;

class CityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ICityRepository::class, CityRepository::class);
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return [
            ICityRepository::class
        ];
    }
}
