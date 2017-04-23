# PSR Test Logger

PSR-3 compliant test and mock loggers to be used in Unit Tests.

[![Latest Stable Version](https://poser.pugx.org/gamez/psr-testlogger/v/stable)](https://packagist.org/packages/gamez/psr-testlogger)
[![Total Downloads](https://poser.pugx.org/gamez/psr-testlogger/downloads)](https://packagist.org/packages/gamez/psr-testlogger)
[![License](https://poser.pugx.org/gamez/psr-testlogger/license)](https://packagist.org/packages/gamez/psr-testlogger)

## Overview

This package provides a Trait that provides two methods:

- [`getTestLogger()`](#gettestlogger)
- [`getMockLogger()`](#getmocklogger)

### `getTestLogger()`

returns a PSR-3 compliant Logger that
stores the records in memory. It provides some helper methods to retrieve
all messages and to check if a message has been logged.

```php
namespace Gamez\Psr\Log;

class TestLogger
{
    /**
     * Returns all log messages.
     *
     * @return string[]
     */
    public function getRecords() {}
    
    /**
     * Checks whether a record with the given (partial) message exists.
     *
     * @param string $needle
     *
     * @return bool
     */
    public function hasRecord($needle) {}
    
    /**
     * Enables the logger to accept non-PSR-3 log levels.
     * 
     * @param bool|null $allowNonPsrLevels
     */
    public function allowNonPsrLevels($allowNonPsrLevels = true) {}
}
```

### `getMockLogger()`
 
is a convenience method for

```php
$this->getMockBuilder('\Psr\Log\LoggerInterface')->getMock();
```

## Installation

```
composer require --dev gamez/psr-testlogger
```

## Usage

```php
use Gamez\Psr\Log\TestLoggerTrait;

class MyUnitTest extends \PHPUnit_Framework_TestCase
{
    use TestLoggerTrait;
    
    protected $logger;
    
    protected function setUp()
    {
        $this->logger = $this->getMockLogger();
        // or
        $this->logger = $this->getTestLogger();
    }
}
```
