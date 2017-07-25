<?php

namespace Aggregator\Providers;

use Illuminate\Support\ServiceProvider;
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleConfigs();
        $this->handleRoutes();
        $this->handleMigrations();
    }

    /**
     * Configuration files.
     */
    private function handleConfigs()
    {
        $configPath = __DIR__ . '/../../config/aggregator.php';

        // Allow publishing the config file, with tag: config
        $this->publishes([$configPath => base_path('config/aggregator.php')], 'config');

        // Merge config files...
        // Allows any modifications from the published config file to be seamlessly merged with default config file
        $this->mergeConfigFrom($configPath, 'aggregator');
    }

    /**
     * Route files.
     */
    private function handleRoutes()
    {
        $this->app->get('channels', '\Aggregator\Controllers\ChannelController@index');
        $this->app->get('channels/search/{type}/{parameter}', '\Aggregator\Controllers\ChannelController@search');
        $this->app->get('channels/{source}/{type}/{parameter}', '\Aggregator\Controllers\ChannelController@show');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Migration files.
     */
    private function handleMigrations()
    {

        // Load the migrations...
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

}
