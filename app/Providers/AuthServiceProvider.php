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

        Gate::define('update-post','App/Policies/PostPolicy@update');

        Gate::define('pegawai', function ($user) {
            return $user->jabatan == 'pegawai';
        });

        Gate::define('owner', function ($user) {
            return $user->jabatan == 'owner';
        });

        //
    }
}
