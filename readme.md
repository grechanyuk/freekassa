# FreeKassa

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require grechanyuk/freekassa
```

``` bash
$ php artisan vendor:publish --provider="Grechanyuk\FreeKassa\FreeKassaServiceProvider" --tag="freekassa.config"
```

Из конфигурационного файла ссылку для принятия уведомлений о статусах платежа от FreeKassa необходимо добавить в исключения CSRF защиты.
Для этого добавьте в файл `App\Http\Middleware\VerifyCsrfToken`:
``` php
protected $except = [
        '/api/freekassa/notificate'
    ];
```

В файл `Kernel.php` добавьте новый Middleware, в секцию `protected $routeMiddleware`:
``` php
'freekassa' => \Grechanyuk\FreeKassa\Middlewares\FreeKassaNotificationChecker::class,
```

## Usage

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [author name][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/grechanyuk/freekassa.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/grechanyuk/freekassa.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/grechanyuk/freekassa/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/grechanyuk/freekassa
[link-downloads]: https://packagist.org/packages/grechanyuk/freekassa
[link-travis]: https://travis-ci.org/grechanyuk/freekassa
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/grechanyuk
[link-contributors]: ../../contributors
