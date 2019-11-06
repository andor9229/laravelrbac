<?php

namespace Andor9229\Rbac;

use Illuminate\Support\ServiceProvider;

class RbacServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallRbac::class
            ]);
        }
    }
}
