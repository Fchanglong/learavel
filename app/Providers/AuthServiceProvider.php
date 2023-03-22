<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Laravel\Passport\RouteRegistrar;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    public function boot()
    {
        $this->registerPolicies();
        // Register Passport routes
        // Passport::routes();
        // Passport::routes(function (RouteRegistrar $router) {
        //     //对于密码授权的方式只要这几个路由就可以了
        //     config(['auth.guards.api.provider' => 'users']);
        //     $router->forAccessTokens();
        // });

        // Set default scope
        // Passport::setDefaultScope(['read']);

        // Enable implicit grant
        // Passport::enableImplicitGrant();
        //
    }
}
