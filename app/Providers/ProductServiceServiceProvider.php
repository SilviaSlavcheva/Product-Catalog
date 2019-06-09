<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            App\Services\ProductServiceInterface::class,
            App\Services\ProductService::class,
        );

        // $this->app->bind(
        //     'App\Services\ProductServiceInterface', 'App\Services\ProductService'
        // );
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
