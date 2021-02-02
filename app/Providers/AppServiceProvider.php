<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Preclaim\ClaimSearchBarOptions as ClaimSearchBarOptions;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // session_start();

        view()->composer('layouts._menu.menu',function($view){
            $view->with('menuItems', \App\Menu::menuBuilder());
        });
    
        // Is there a better place for this?
        view()->composer('preclaim.searchbar.batchTypeSearch', function($view){
            $view->with('claimSearchItems', ClaimSearchBarOptions::GetBatchTypes());
        });

        view()->composer('preclaim.searchbar.claimStatusSearch', function($view){
            $view->with('claimSearchItems', ClaimSearchBarOptions::GetClaimStatuses());
        });

        view()->composer('preclaim.searchbar.userQueueSearch', function($view){
            $view->with('claimSearchItems', ClaimSearchBarOptions::GetUserQueues());
        });

    }
}
