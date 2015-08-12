<?php

/*
 * This file is part of the PHP Test Logger package.
 *
 * Copyright (c) Jérôme Gamez <jerome@gamez.name>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gamez\Psr\Log\Test;

use Gamez\Psr\Log\TestLogger;
use Gamez\Psr\Log\TestLoggerTrait;
use Psr\Log\LogLevel;
use Psr\Log\Test\LoggerInterfaceTest;

class TestLoggerTest extends LoggerInterfaceTest
{
    use TestLoggerTrait;

    /**
     * @var TestLogger
     */
    private $testLogger;

    public function getLogger()
    {
        return $this->testLogger = $this->getTestLogger();
    }

    public function getLogs()
    {
        return $this->testLogger->getRecords();
    }

    public function testHasRecord()
    {
        $logger = $this->getLogger();

        $level = LogLevel::INFO;
        $message = 'Message {user}';
        $context = ['user' => 'Bob'];

        $logger->{$level}($message, $context);

        $record = sprintf('%s %s', strtolower($level), $message);

        foreach ($context as $key => $value) {
            $record = str_replace('{'.$key.'}', $value, $record);
        }

        $shortenedRecord = substr($record, 0, strlen($record) - 3);
        $partialRecord   = substr($record, 3, strlen($record) - 3);

        $this->assertTrue($logger->hasRecord($record));
        $this->assertTrue($logger->hasRecord($shortenedRecord));
        $this->assertTrue($logger->hasRecord($partialRecord));

        $this->assertFalse($logger->hasRecord('non-existent'));
    }

    public function testAllowNonPsrLevels()
    {
        $logger = $this->getLogger();
        $logger->allowNonPsrLevels();

        $logger->log('non-psr', 'message');

        $this->assertTrue($logger->hasRecord('message'));
    }
}
