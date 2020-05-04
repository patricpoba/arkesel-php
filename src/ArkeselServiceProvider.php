<?php

namespace PatricPoba\Arkesel;

use PatricPoba\Arkesel\Sms;
use Illuminate\Support\ServiceProvider;

class ArkeselServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */ 
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('arkesel.php'),
            ], 'config'); 
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'arkesel');

        // Register the main class to use with the facade
        $this->app->singleton('arkesel-sms', function () {
            return new Sms;
        });
    }
}
