<?php

namespace Grechanyuk\FreeKassa;

use Illuminate\Support\ServiceProvider;

class FreeKassaServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'grechanyuk');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'grechanyuk');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/freekassa.php', 'freekassa');
        $this->mergeConfigFrom(__DIR__.'/../config/freekassaCurrency.php', 'freekassaCurrency');

        // Register the service the package provides.
        $this->app->singleton('freekassa', function ($app) {
            return new FreeKassa;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['freekassa'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/freekassa.php' => config_path('freekassa.php'),
        ], 'freekassa.config');

        $this->publishes([
            __DIR__.'/../config/freekassaCurrency.php' => config_path('freekassaCurrency.php'),
        ], 'freekassaCurrency.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/grechanyuk'),
        ], 'freekassa.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/grechanyuk'),
        ], 'freekassa.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/grechanyuk'),
        ], 'freekassa.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
