<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\UserRepositoryInterface', 'App\Repositories\UserRepository');
		$this->app->bind('App\Repositories\Contracts\NotificationRepositoryInterface', 'App\Repositories\NotificationRepository');
		$this->app->bind('App\Repositories\Contracts\RoleRepositoryInterface', 'App\Repositories\RoleRepository');
    }
}
