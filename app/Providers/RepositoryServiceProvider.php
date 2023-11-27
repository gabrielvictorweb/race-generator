<?php

namespace App\Providers;

use App\Repositories\Interfaces\{
    RacingRepositoryInterface
};

use App\Repositories\{
    RacingRepository
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
            RacingRepositoryInterface::class,
            RacingRepository::class,
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
