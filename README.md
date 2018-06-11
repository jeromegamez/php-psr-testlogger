# PSR Test Logger

PSR-3 compliant test logger for developers who like tests and want
to check if their application logs messages as they expect.

[![Packagist](https://img.shields.io/packagist/v/gamez/psr-testlogger.svg)](https://packagist.org/packages/gamez/psr-testlogger)
[![Supported PHP version](https://img.shields.io/packagist/php-v/gamez/psr-testlogger.svg)]()
[![Build Status](https://travis-ci.org/jeromegamez/php-psr-testlogger.svg?branch=master)](https://travis-ci.org/jeromegamez/php-psr-testlogger)
[![GitHub license](https://img.shields.io/github/license/jeromegamez/php-psr-testlogger.svg)](https://github.com/jeromegamez/php-psr-testlogger/blob/master/LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/gamez/psr-testlogger.svg)]()

## Installation

```
composer require --dev gamez/psr-testlogger
```

## Usage

Inject an instance of `Gamez\Psr\Log\TestLogger` into your Subject Under Test
instead of your regular logger.

```php
use Psr\Log\LoggerInterface;

class SubjectUnderTest
{
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->info('Message with a {placeholder}', ['placeholder' => 'value']);
        $this->logger->emergency('This {placeholder} will not be replaced.');
    }
}
```

```php
use Gamez\Psr\Log\TestLogger;
use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{
    /**
     * @var TestLogger
     */
    private $logger;

    /**
     * @var SubjectUnderTest
     */
    private $sut;

    protected function setUp()
    {
        $this->logger = new TestLogger();
        $this->sut = new SubjectUnderTest($this->logger);
    }
    
    public function testLogging()
    {
        $this->sut->execute();
        
        $log = $this->logger->log;
        
        $this->assertTrue($log->has('Message with a value'));
        $this->assertTrue($log->hasRecordsWithContextKey('foo'));
        $this->assertFalse($log->hasRecordsWithContextKeyAndValue('foo', 'unwanted'));
        // This will break
        $this->assertFalse($log->hasRecordsWithUnreplacedPlaceholders());
    }
}
```

You can find all available helper methods in the [`Gamez\Psr\Log\Log` class](src/Log.php). If it
doesn't provide a method you need, you can use your own filters:

```php
use Gamez\Psr\Log\Record;
use Gamez\Psr\Log\TestLogger;
use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{
    /**
     * @var TestLogger
     */
    private $logger;

    /**
     * @var SubjectUnderTest
     */
    private $sut;

    protected function setUp()
    {
        $this->logger = new TestLogger();
        $this->sut = new SubjectUnderTest($this->logger);
    }
    
    public function testSomethingSpecial()
    {
        $filteredLog = $this->logger->log->filter(function (Record $record) {
            // Matches messages with only numbers
            return ctype_digit($record->message);
        });
        
        $this->assertCount(0, $filteredLog);
    }
}
```
