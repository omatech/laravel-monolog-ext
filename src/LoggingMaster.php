<?php

namespace Omatech\LaravelMonologExt;

use Omatech\LaravelMonologExt\Contracts\MonologLogging;
use Illuminate\Support\Facades\App;

class LoggingMaster implements MonologLogging
{

    protected $loggings = [];

    public function __construct()
    {
        foreach (config('laravel-monolog-ext.drivers') as $driver) {
            $this->loggings[] = App::make($driver['class']);
        }
    }

    public function pushHandler(\Monolog\Logger $monolog)
    {
        foreach ($this->loggings as $logging) {
            $logging->pushHandler($monolog);
        }
    }
}
