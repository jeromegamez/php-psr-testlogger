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

use Gamez\Psr\Log\TestLoggerTrait;

class MockLoggerTest extends TestCase
{
    use TestLoggerTrait;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $logger;

    protected function setUp()
    {
        $this->logger = $this->getMockLogger();
    }

    /**
     * @dataProvider logLevelProvider
     */
    public function testLog($level)
    {
        $this->logger
            ->expects($this->once())
            ->method($level)
            ->with($level);

        call_user_func([$this->logger, $level], $level);
    }
}
