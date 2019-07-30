<?php

namespace Omatech\LaravelMonologExt;

use Illuminate\Support\ServiceProvider;
use Omatech\LaravelMonologExt\Contracts\MonologLogging;

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

        $system = config('laravel-monolog-ext.default');

        $this->app->bind(MonologLogging::class, config('laravel-monolog-ext.systems')[$system]);
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
