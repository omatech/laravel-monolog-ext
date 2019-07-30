<?php

namespace Omatech\LaravelMonologExt\CloudWatch;

use Illuminate\Support\Facades\App;
use Monolog\Formatter\LineFormatter;
use Maxbanton\Cwh\Handler\CloudWatch;
use Omatech\LaravelMonologExt\Contracts\MonologLogging;

class CloudWatchLaravelLogging implements MonologLogging
{
    protected $cwHandlerApp;

    public function __construct()
    {
        $cwClient = App::make('aws')->createClient('CloudWatchLogs');
        $cwGroupName = 'mediktiv/' . env('APP_ENV') . '/' . env('APP_NAME');
        $cwStreamNameApp = 'laravel-' . now()->toDateString() . '.log';
        $cwRetentionDays = 90;
        $this->cwHandlerApp = new CloudWatch($cwClient, $cwGroupName, $cwStreamNameApp, $cwRetentionDays);
    }

    public function pushHandler(\Monolog\Logger $monolog)
    {
        $monolog->pushHandler($this->cwHandlerApp);
        $this->cwHandlerApp->setFormatter(tap(new LineFormatter(null, null, true, true), function ($formatter) {
            $formatter->includeStacktraces();
        }));
    }
}
