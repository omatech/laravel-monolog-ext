<?php

namespace Omatech\LaravelMonologExt\File;

use Illuminate\Support\Facades\App;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Omatech\LaravelMonologExt\Contracts\MonologLogging;

class FileLaravelLogging implements MonologLogging
{

    public function pushHandler(\Monolog\Logger $monolog)
    {
        $path = App::storagePath() . '/logs/laravel.log';
        $monolog->pushHandler($handler = new RotatingFileHandler($path));
        $handler->setFormatter(tap(new LineFormatter(null, null, true, true), function ($formatter) {
            $formatter->includeStacktraces();
        }));
    }
}
