<?php

namespace Omatech\LaravelMonologExt\CloudWatch;

use Exception;
use Illuminate\Support\Facades\App;
use Monolog\Formatter\LineFormatter;
use Maxbanton\Cwh\Handler\CloudWatch;
use Omatech\LaravelMonologExt\Contracts\MonologLoggingChild;

class CloudWatchLaravelLogging implements MonologLoggingChild
{
    protected $cwHandlerApp;

    public function __construct()
    {
        $cwClient = App::make('aws')->createClient('CloudWatchLogs');
        $cwGroupName = config('laravel-monolog-ext.drivers.cloudwatch.group') . '/' . strtolower(env('APP_ENV'));
        $cwStreamNameApp = 'laravel-' . now()->toDateString() . '.log';
        $cwRetentionDays = config('laravel-monolog-ext.drivers.cloudwatch.retention');
        $cwLevel = config('laravel-monolog-ext.drivers.cloudwatch.level');
        $this->cwHandlerApp = new CloudWatch($cwClient, $cwGroupName, $cwStreamNameApp, $cwRetentionDays, 10000, [], $cwLevel);
    }

    public function pushHandler(\Monolog\Logger $monolog)
    {
        $monolog->pushHandler($this->cwHandlerApp);
        $this->cwHandlerApp->setFormatter(tap(new LineFormatter(null, null, true, true), function ($formatter) {
            $formatter->includeStacktraces();
        }));
    }
}
