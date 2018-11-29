<?php

namespace Medoucine\Doctor\App\Laravel;

use Medoucine\Doctor\Domain\DoctorRepository;
use Medoucine\Doctor\Domain\IDoctorRepository;
use Illuminate\Support\ServiceProvider;

class DoctorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(IDoctorRepository::class, DoctorRepository::class);
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return [
            IDoctorRepository::class
        ];
    }
}
