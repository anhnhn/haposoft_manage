<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\User;
use App\Policies\CustomerPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Auth;
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
        User::class => UserPolicy::class,
        Customer::class => CustomerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('showReport', 'App\Policies\UserPolicy@showReport');
        Gate::define('updateReport', 'App\Policies\UserPolicy@updateReport');
        Gate::define('createReport', 'App\Policies\UserPolicy@createReport');
        Gate::define('viewProject', 'App\Policies\CustomerPolicy@viewProject');
        Gate::define('viewProjectUser', 'App\Policies\UserPolicy@viewProjectUser');
    }
}
