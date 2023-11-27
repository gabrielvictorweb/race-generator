<?php

namespace App\Providers;

use App\Repositories\Interfaces\{
    RaceRepositoryInterface
};

use App\Repositories\{
    RaceRepository
};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            RaceRepositoryInterface::class,
            RaceRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
