<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dingo\Api\Auth\Auth;
use Dingo\Api\Auth\Provider\OAuth2;
use App\Models\User;

/**
 * OAuth service provider
 *
 * Class OAuthServiceProvider
 * @package App\Providers
 */
class OAuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app[Auth::class]->extend('oauth', function ($app) {

            $provider = new OAuth2($app['oauth2-server.authorizer']->getChecker());

            $provider->setUserResolver(function ($id) {
                return User::find($id);
            });

            $provider->setClientResolver(function ($id) {
                // Logic to return a client by their ID.
            });

            return $provider;
        });
    }

    public function register()
    {
        //
    }
}
