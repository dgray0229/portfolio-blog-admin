<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Change default email length to allow migration
        /**
        * This is in case you leave the default settings for your config/database.php
        * 'charset' => 'utf8mb4',
        * 'collation' => 'utf8mb4_unicode_ci',
        */
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);

        \Blade::if('admin', function () {            
            if (auth()->user() && auth()->user()->hasRole('admin')) {
                return 1;
            }
            return 0;
        });
    }
}
