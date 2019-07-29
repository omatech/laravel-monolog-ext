# Laravel Monolog Extension

[![Latest Version on Packagist](https://img.shields.io/packagist/v/omatech/laravel-monolog-ext.svg?style=flat-square)](https://packagist.org/packages/omatech/laravel-monolog-ext)
[![Total Downloads](https://img.shields.io/packagist/dt/omatech/laravel-monolog-ext.svg?style=flat-square)](https://packagist.org/packages/omatech/laravel-monolog-ext)

This package is to send  logs of Laravel framework, to different services, now only you can send to `CloudWatch`.


## Installation

You can install the package via composer:

```bash
composer require omatech/laravel-monolog-ext
```

## Usage

**CloudWatch**:

First you need to configurate credentials and region settings AWS ( see: [aws/aws-sdk-php-laravel](https://github.com/aws/aws-sdk-php-laravel) ).

In `bootstrap\app.php`, you need to add this:
``` php
$app->configureMonologUsing(function ($monolog) {
    $logger = App::make(MonologLogging::class);
    $logger->pushHandler($monolog);
});
```

If you want to add another service, you need to publish the config file.
```sh
php artisan vendor:publish  --provider="Omatech\LaravelMonologExt\LaravelMonologExtServiceProvider"
```

The settings can be found in the generated `config/laravel-monolog-ext.php` configuration file. By default, you have the CloudWatch service.

```php
return [
    'logging-service' => Omatech\LaravelMonologExt\CloudWatch\CloudWatchLaravelLogging::class
];
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email apons@omatech.com instead of using the issue tracker.

## Credits

- [Cesc Delgado](https://github.com/omacesc)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

