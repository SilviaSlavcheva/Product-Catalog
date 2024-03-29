<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('accessAdminpanel', function ($user) {
            return $user->role('admin');
        });

        Gate::define('accessProfile', function ($user) {
            return $user->role('member');
        });

        Gate::define('canAccess', function ($user, $product) {
            return $user->id === $product->user_id;
        });
    }
}
