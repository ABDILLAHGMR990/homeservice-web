<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin', fn($user) => $user->role === 'admin');
        Gate::define('provider', fn($user) => $user->role === 'provider');
        Gate::define('customer', fn($user) => $user->role === 'customer');
    }
}
