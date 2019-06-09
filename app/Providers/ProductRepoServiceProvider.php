<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ProductRepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(
        //     App\Repositories\ProductRepoInterface::class,
        //     App\Repositories\ProductRepo::class,
        // );

        $this->app->bind(
            'App\Repositories\ProductRepoInterface', 'App\Repositories\ProductRepo'
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
