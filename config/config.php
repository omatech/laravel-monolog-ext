<?php
$data = ['drivers'];

if (env('APP_LOG_DRIVER_AWS', false)) {
    if (empty(env('APP_LOG_DRIVER_AWS_GROUP'))) {
        throw new Exception('No defined APP_LOG_DRIVER_AWS_GROUP');
    }
    $data['drivers']['cloudwatch'] = [
        'group' => env('APP_LOG_DRIVER_AWS_GROUP'),
        'level' => env('APP_LOG_LEVEL', 'debug'),
        'retention' => env('APP_LOG_RETENTION', 140),
        'class' => Omatech\LaravelMonologExt\CloudWatch\CloudWatchLaravelLogging::class,
    ];
}

if (env('APP_LOG_DRIVER_FILE', false)) {
    $data['drivers']['file'] = [
        'level' => env('APP_LOG_LEVEL', 'debug'),
        'class' => Omatech\LaravelMonologExt\File\FileLaravelLogging::class
    ];
}

return $data;
