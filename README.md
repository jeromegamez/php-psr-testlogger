# PSR Test Logger

PSR-3 compliant test and mock loggers to be used in Unit Tests.

## Overview

This package provides a Trait that provides two methods:

**`$this->getTestLogger()`** returns a PSR-3 compliant Logger that
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

**`$this->getMockLogger()`** is a convenience method for
`$this->getMockBuilder('\Psr\Log\LoggerInterface')->getMock();`.

## Installation

```
composer require gamez/psr-testlogger
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
