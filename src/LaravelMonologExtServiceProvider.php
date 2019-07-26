<?php

namespace Omatech\LaravelMonologExt;

use Illuminate\Support\ServiceProvider;
use Omatech\LaravelMonologExt\Contracts\MonologLogging;
use Omatech\LaravelMonologExt\CloudWatch\CloudWatchLaravelLogging;

class LaravelMonologExtServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('laravel-monolog-ext.php'),
            ], 'config');
        }

        $this->app->bind(MonologLogging::class, config('laravel-monolog-ext.logging-service'));
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravel-monolog-ext');
    }
}
