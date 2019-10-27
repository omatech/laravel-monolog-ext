<?php
$data = ['drivers'];

if (env('APP_LOG_DRIVER_AWS', false)) {
    if (empty(env('APP_LOG_DRIVER_AWS_GROUP'))) {
        throw new Exception('No defined APP_LOG_DRIVER_AWS_GROUP');
    }
    $group = env('APP_LOG_DRIVER_AWS_GROUP') . '/' . strtolower(env('SERVICE_NAME'));
    if (!empty(env('SERVICE_NAME_CONTAINER'))) {
        $group .= '/'.env('SERVICE_NAME_CONTAINER');
    }
    $data['drivers']['cloudwatch'] = [
        'group' => $group,
        'level' => env('APP_LOG_LEVEL', 'debug'),
        'retention' => env('APP_LOG_RETENTION', 140),
        'class' => Omatech\LaravelMonologExt\CloudWatch\CloudWatchLaravelLogging::class,
    ];
}

if (env('APP_LOG_DRIVER_FILE', true)) {
    $data['drivers']['file'] = [
        'level' => env('APP_LOG_LEVEL', 'debug'),
        'class' => Omatech\LaravelMonologExt\File\FileLaravelLogging::class
    ];
}

return $data;
