<?php

namespace Gamez\Psr\Log\Tests;

use Gamez\Psr\Log\Record;
use Gamez\Psr\Log\TestLogger;
use Psr\Log\LogLevel;
use Psr\Log\Test\LoggerInterfaceTest;

class TestLoggerTest extends LoggerInterfaceTest
{
    /**
     * @var TestLogger
     */
    private $testLogger;

    public function getLogger()
    {
        return $this->testLogger = new TestLogger();
    }

    public function getLogs(): array
    {
        return array_map(function (Record $record) {
            return sprintf('%s %s', $record->level, $record->message);
        }, $this->testLogger->log->getItems());
    }

    public function testAssertions()
    {
        $logger = $this->getLogger();
        $logger->info('Message with a {placeholder} and a context.', ['placeholder' => 'value']);
        $logger->debug('Message with a {placeholder} and no context.');
        $logger->warning('Message with no placeholders and a context', ['key' => 'value']);

        // Fuzzy searches over levels and messages
        $this->assertTrue($logger->log->has(LogLevel::DEBUG));
        $this->assertFalse($logger->log->has(LogLevel::EMERGENCY));
        $this->assertTrue($logger->log->has('value'));
        $this->assertTrue($logger->log->has('no context'));
        $this->assertFalse($logger->log->has('something'));

        // Hasers
        $this->assertTrue($logger->log->hasRecordsWithLevel(LogLevel::DEBUG));
        $this->assertFalse($logger->log->hasRecordsWithLevel(LogLevel::ERROR));
        $this->assertTrue($logger->log->hasRecordsWithUnreplacedPlaceholders());
        $this->assertTrue($logger->log->hasRecordsWithMessage('Message with a value and a context.'));
        $this->assertTrue($logger->log->hasRecordsWithPartialMessage('value'));
        $this->assertTrue($logger->log->hasRecordsWithContextKey('placeholder'));
        $this->assertTrue($logger->log->hasRecordsWithContextKeyAndValue('key', 'value'));

        // Counters
        $this->assertSame(1, $logger->log->countRecordsWithLevel(LogLevel::DEBUG));
        $this->assertSame(0, $logger->log->countRecordsWithLevel(LogLevel::ERROR));
        $this->assertSame(1, $logger->log->countRecordsWithUnreplacedPlaceholders());
        $this->assertSame(1, $logger->log->countRecordsWithMessage('Message with a value and a context.'));
        $this->assertSame(1, $logger->log->countRecordsWithPartialMessage('value'));
        $this->assertSame(1, $logger->log->countRecordsWithContextKey('placeholder'));
        $this->assertSame(1, $logger->log->countRecordsWithContextKeyAndValue('key', 'value'));
    }
}
