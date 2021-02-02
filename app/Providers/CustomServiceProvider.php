<?php

namespace App\Providers;

use App\User;

use App\Providers\Login\LoginUserProvider as LoginUserProvider;

use App\CustomUserProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Hashing\BcryptHasher;

class CustomServiceProvider extends ServiceProvider
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
        $this->app['auth']->provider('custom', function()
        {
            return new LoginUserProvider(new BcryptHasher, User::class);
        });
    }
}