# Doctane

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![StyleCI][ico-styleci]][link-styleci]

Simple package to create and run docker image preconfigured for Laravel Octane + Swoole and Kafka.

## Installation

Via Composer

``` bash
$ composer require werk365/doctane
```

## Usage

``` bash
$ php artisan doctane:install
```
Builds an image from the provided Dockerfile


``` bash
$ php artisan doctane:start
```
Creates and starts container based on image, exposing port 8000, mounting your application directory and starting an octane (swoole) server


``` bash
$ php artisan doctane:stop
```
Shuts down container

``` bash
$ php artisan doctane:reload
```
Reload octane workers in container


``` bash
$ php artisan doctane:status
```
Check octane server status in container

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

[ico-version]: https://img.shields.io/packagist/v/werk365/doctane.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/werk365/doctane.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/werk365/doctane/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/366024317/shield

[link-packagist]: https://packagist.org/packages/werk365/doctane
[link-downloads]: https://packagist.org/packages/werk365/doctane
[link-travis]: https://travis-ci.org/werk365/doctane
[link-styleci]: https://styleci.io/repos/366024317
[link-author]: https://github.com/werk365
[link-contributors]: ../../contributors
