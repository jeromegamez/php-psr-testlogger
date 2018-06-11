# CHANGELOG

## Unreleased

### Breaking Changes

* Deprecated methods and traits have been removed

### Bugfixes

* Fixed return types of count methods ([#4](https://github.com/jeromegamez/php-psr-testlogger/pull/4))

### Changes

* Added Travis CI configuration ([#5](https://github.com/jeromegamez/php-psr-testlogger/pull/5))

## 2.0.0 - 2017-05-13

* Breaking changes 
  * The library requires PHP 7.0 or newer
  * The TestLogger will throw an InvalidArgumentException when an undefined
    LogLevel is used (see [PSR-3: Basics](http://www.php-fig.org/psr/psr-3/#basics))
* The `TestLoggerTrait` is deprecated
* The methods `TestLogger::getRecords()` and `TestLogger::hasRecord()` are deprecated
* Everything is an object, you can retrieve and work with:
  * The TestLogger has a Log
  * The Log has Records
  * Each Record has a Level, a Message and a Context
* See the updated README for the new usage.

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
