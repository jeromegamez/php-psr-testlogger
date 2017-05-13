<?php


namespace Gamez\Psr\Log\Test;

use Gamez\Psr\Log\TestLogger;
use Gamez\Psr\Log\TestLoggerTrait;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use Psr\Log\LoggerInterface;

class TestLoggerTraitTest extends TestCase
{
    use TestLoggerTrait;

    /**
     * @var LoggerInterface|PHPUnit_Framework_MockObject_MockObject
     */
    protected $logger;

    /**
     * @deprecated
     */
    public function testGetMockLogger()
    {
        $logger = $this->getMockLogger();

        $this->assertInstanceOf(PHPUnit_Framework_MockObject_MockObject::class, $logger);
        $this->assertInstanceOf(LoggerInterface::class, $logger);
    }

    public function testGetTestLogger()
    {
        $logger = $this->getTestLogger();

        $this->assertInstanceOf(TestLogger::class, $logger);
    }
}
