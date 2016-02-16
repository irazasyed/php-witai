# PHP-Witai Library

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

> PHP Library for Wit.ai API with Laravel & Lumen Support out of the box!

## Install

Via Composer

``` bash
$ composer require irazasyed/php-witai
```

## Usage

``` php
$wit = new Irazasyed\Wit($access_token, $isAsyncRequests = false);
$response = $wit->getIntentByText('Whats the weather like in San Francisco?', $optional_params);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email syed+gh@lukonet.com instead of using the issue tracker.

## Credits

- [Syed Irfaq R.][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/irazasyed/php-witai.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/irazasyed/php-witai/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/irazasyed/php-witai.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/irazasyed/php-witai.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/irazasyed/php-witai.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/irazasyed/php-witai
[link-travis]: https://travis-ci.org/irazasyed/php-witai
[link-scrutinizer]: https://scrutinizer-ci.com/g/irazasyed/php-witai/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/irazasyed/php-witai
[link-downloads]: https://packagist.org/packages/irazasyed/php-witai
[link-author]: https://github.com/irazasyed
[link-contributors]: ../../contributors
