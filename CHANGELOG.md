# CHANGELOG

## 1.0.5 - 2017-04-23

* Made the `composer.json` more explicit concerning the minimum required PHP version

This is the last release supporting PHP 5.x.

## 1.0.4 - 2017-04-23

* Reverted the addition of PHPUnit ^6.0 as the current test suite isn't compatible with it

## 1.0.3 - 2017-04-23

* Moved `psr/log` package from dev to actual requirements ([#2](https://github.com/jeromegamez/php-psr-testlogger/issues/2))
* Added a `provide` section to the `composer.json` so that this package can be found on packagist as a `psr/log-implementation`
* Added PHPUnit ^6.0 as a supported dev dependency

## 1.0.2 - 2016-01-31

* Fixed wrong number of arguments in `sprintf()` call

## 1.0.1 - 2015-11-17

* Adds support for PHPUnit 5.0 as a dependency

## 1.0 - 2015-08-13

* Initial release
