<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('edit-users', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('manage-users', function ($user) {
            return $user->asAnyProfils(['admin']);   
        });
        Gate::define('bloque-users', function ($user) {
            return $user->isAdmin();
        });
    }
}
