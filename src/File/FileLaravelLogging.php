<?php

namespace Omatech\LaravelMonologExt\File;

use Illuminate\Support\Facades\App;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Omatech\LaravelMonologExt\Contracts\MonologLoggingChild;

class FileLaravelLogging implements MonologLoggingChild
{

    public function pushHandler(\Monolog\Logger $monolog)
    {
        $path = App::storagePath() . '/logs/laravel.log';
        $level = config('laravel-monolog-ext.drivers.file.level');

        $monolog->pushHandler($handler = new RotatingFileHandler($path, 0, $level));
        $handler->setFormatter(tap(new LineFormatter(null, null, true, true), function ($formatter) {
            $formatter->includeStacktraces();
        }));
    }
}
