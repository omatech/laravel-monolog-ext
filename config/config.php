<?php

return [
    'default' => env('LOG_SYSTEM', 'file'),

    'systems' => [
        'cloudwatch' => Omatech\LaravelMonologExt\CloudWatch\CloudWatchLaravelLogging::class,
        'file' => Omatech\LaravelMonologExt\File\FileLaravelLogging::class
    ]
];
