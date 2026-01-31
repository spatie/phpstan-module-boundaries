# A PhpStan plugin to keep make classes private for their contexts

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/phpstan-module-boundaries.svg?style=flat-square)](https://packagist.org/packages/spatie/phpstan-module-boundaries)
[![Tests](https://github.com/spatie/phpstan-module-boundaries/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/spatie/phpstan-module-boundaries/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/phpstan-module-boundaries.svg?style=flat-square)](https://packagist.org/packages/spatie/phpstan-module-boundaries)

This plugin is just a proof of concept for now. The goal is to have a linter that allows the developer to specify which classes can and can't be used across contexts. For example, a `StripePayment` class that's an implementation detail of the `Payment` context shouldn't be used in the `Order` context.

```
$ ./vendor/bin/phpstan analyse
Note: Using configuration file /Users/sebastiandedeyne/Sites/phpstan-module-boundaries/phpstan.neon.
 4/4 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 ------ -----------------------------------------------------------------------
  Line   Context/Order/Order.php
 ------ -----------------------------------------------------------------------
  21     Internal class App\Context\Payment\Internal\StripePayment was used in
         Order module.
 ------ -----------------------------------------------------------------------



 [ERROR] Found 1 error
```

In this bare-bones implementation, classes nested in an `Internal` namespace aren't allowed to be used in other context. In the future, I'll probably provide an `#[Internal]` `#[Expose]` attribute to flag classes as (in)accessible for other contexts.

This idea is inspired by Java's class visibility. In Java, a class is only visible in the package it lives in. You need to explicitly make it `public` to allow others to use it.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/phpstan-module-boundaries.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/phpstan-module-boundaries)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/phpstan-module-boundaries
```

## Usage

```php
$skeleton = new Spatie\PhpStanModuleBoundaries();
echo $skeleton->echoPhrase('Hello, Spatie!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.