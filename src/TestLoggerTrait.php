<?php

namespace Gamez\Psr\Log;

use Psr\Log\LoggerInterface;

/**
 * @deprecated 2.0.0
 *
 * @method \PHPUnit_Framework_MockObject_MockObject createMock($class)
 */
trait TestLoggerTrait
{
    /**
     * @deprecated 2.0.0 use \PHPUnit\Framework\TestCase::createMock(\Psr\Log\LoggerInterface::class) instead
     *
     * @return \Psr\Log\LoggerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockLogger()
    {
        return $this->createMock(LoggerInterface::class);
    }

    /**
     * @deprecated 2.0.0 use new \Gamez\Psr\Log\TestLogger() instead
     */
    protected function getTestLogger(): TestLogger
    {
        return new TestLogger();
    }
}
