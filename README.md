# register-adries

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Provides communication with https://data.gov.sk/dataset/register-adries in PHP via PSR-18 http client

## Install

Via Composer

```bash
$ composer require digitalcz/register-adries
```

## Usage

```php
$register = new DigitalCz\RegisterAdries\RegisterAdries();

$response = $register
    ->request()   // creates RequestBuilder
    ->regions()   // set resource to fetch
    ->limit(5)    // max number of result (default 100)
    ->offset(5)   // position of first result (default 0)
    ->execute();  // executes the request and return results 

$response->getRecords(); // array of DigitalCz\RegisterAdries\Response\Region
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
$ composer phpstan
$ composer cs       # codesniffer
$ composer csfix    # code beautifier
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email info@digital.cz instead of using the issue tracker.

## Credits

- [Digital Solutions s.r.o.][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/digitalcz/register-adries.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/digitalcz/register-adries/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/digitalcz/register-adries.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/digitalcz/register-adries.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/digitalcz/register-adries.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/digitalcz/register-adries
[link-travis]: https://travis-ci.org/digitalcz/register-adries
[link-scrutinizer]: https://scrutinizer-ci.com/g/digitalcz/register-adries/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/digitalcz/register-adries
[link-downloads]: https://packagist.org/packages/digitalcz/register-adries
[link-author]: https://github.com/digitalcz
[link-contributors]: ../../contributors
