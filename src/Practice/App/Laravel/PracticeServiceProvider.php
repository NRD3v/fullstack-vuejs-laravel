<?php

namespace Medoucine\Practice\App\Laravel;

use Illuminate\Support\ServiceProvider;
use Medoucine\Practice\Domain\IPracticeRepository;
use Medoucine\Practice\Domain\PracticeRepository;

class PracticeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(IPracticeRepository::class, PracticeRepository::class);
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return [
            IPracticeRepository::class
        ];
    }
}