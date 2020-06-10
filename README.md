# register-adries

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Provides communication with https://data.gov.sk/dataset/register-adries in PHP OOP via PSR-18 HTTP client

## Install

Via Composer

```bash
$ composer require digitalcz/register-adries
```

## Usage

```php
$register = new DigitalCz\RegisterAdries\RegisterAdries();

$response = $register
    ->request()             // create RequestBuilder
    ->regions()             // set resource to fetch
    ->limit(5)              // limit number of results
    ->offset(10)            // offset first result
    ->execute();            // execute the request and return response 

$response->getRecords();    // DigitalCz\RegisterAdries\Response\Region[]
$response->getTotal();      // total number of results
```

#### With conditions

```php
$register = new DigitalCz\RegisterAdries\RegisterAdries();

$register
    ->request()                         // create RequestBuilder
    // comparison
    ->whereEq('foo', 'bar')             // `foo = bar`
    ->whereGt('foo', 40)                // `foo > 40` 
    ->whereGte('foo', 40)               // `foo >= 40` 
    ->whereLt('foo', 40)                // `foo < 40` 
    ->whereLte('foo', 40)               // `foo <= 40` 
    // like
    ->whereLike('foo', 'bar')           // `foo LIKE bar`
    ->whereStartsWith('foo', 'bar')     // `foo LIKE bar%`
    ->whereEndsWith('foo', 'bar')       // `foo LIKE %bar`
    ->wherePartial('foo', 'bar')        // `foo LIKE %bar%`
    // helpers
    ->whereObjectId(12)                 // `objectId = 12`
    ->onlyValid();                      // `WHERE {now} > validFrom AND {now} < validTo`
```

#### Requesting by objectId
```php
$register = new DigitalCz\RegisterAdries\RegisterAdries();
$register->findRegion(9);           // returns DigitalCz\RegisterAdries\Response\Region or null
$register->findCounty(9);           // returns DigitalCz\RegisterAdries\Response\County or null
$register->findMunicipality(9);     // returns DigitalCz\RegisterAdries\Response\Municipality or null
$register->findDistrict(9);         // returns DigitalCz\RegisterAdries\Response\District or null
$register->findStreet(9);           // returns DigitalCz\RegisterAdries\Response\Street or null
$register->findUnit(9);             // returns DigitalCz\RegisterAdries\Response\Unit or null
$register->findBuilding(9);         // returns DigitalCz\RegisterAdries\Response\Building or null
$register->findEntrance(9);         // returns DigitalCz\RegisterAdries\Response\Entrance or null
```

#### Available resources
 - region - https://data.gov.sk/dataset/register-adries-register-krajov
 - county - https://data.gov.sk/dataset/register-adries-register-okresov
 - municipality - https://data.gov.sk/dataset/register-adries-register-obci
 - district - https://data.gov.sk/dataset/register-adries-register-casti-obci
 - street - https://data.gov.sk/dataset/register-adries-register-ulic
 - unit - https://data.gov.sk/dataset/register-adries-register-bytov
 - building - https://data.gov.sk/dataset/register-adries-register-budov
 - entrance - https://data.gov.sk/dataset/register-adries-register-vchodov

Available on builder as
```php
$register 
    // ...
    ->regions()
    ->counties()
    ->municipalities()
    ->districts()
    ->streets()
    ->units()
    ->buildings()
    ->entrances();
// It isn't possible to chain more resources, this is just example
```

#### Using your own http client

You can provide PSR18 http client (and PSR17 factories) when creating instance of RegisterAdries, if no arguments are provided Psr18ClientDiscovery and Psr17FactoryDiscovery will be used (see https://php-http.readthedocs.io/en/latest/discovery.html).
```php
// example
$symfonyHttpClient = Symfony\Component\HttpClient\Psr18Client();

$register = new DigitalCz\RegisterAdries\RegisterAdries(
    $symfonyHttpClient, 
    $symfonyHttpClient   // symfony PSR18 client is also PSR17 factory
);
```


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer tests
$ composer phpstan
$ composer cs       # code sniffer
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
