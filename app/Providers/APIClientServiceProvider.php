<?php

namespace App\Providers;

use App\Services\API\APIClientService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class APIClientServiceProvider extends ServiceProvider
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
        $this->app->singleton('api_client', function () {
            return new APIClientService(
                app()->make(Client::class)
            );
        });
    }
}
