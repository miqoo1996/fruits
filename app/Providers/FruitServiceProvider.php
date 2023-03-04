<?php

namespace App\Providers;

use App\Repositories\FruitRepository;
use App\Repositories\NutritionRepository;
use App\Services\FruitService;
use Carbon\Laravel\ServiceProvider;

class FruitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('fruits', function () {
            return new FruitService(
                app()->make(FruitRepository::class),app()->make(NutritionRepository::class)
            );
        });
    }
}
