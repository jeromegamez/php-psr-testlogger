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

class TestLoggerTraitTest extends TestCase
{
    use TestLoggerTrait;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $logger;

    public function testGetMockLogger()
    {
        $logger = $this->getMockLogger();

        $this->assertInstanceOf('\PHPUnit_Framework_MockObject_MockObject', $logger);
        $this->assertInstanceOf('\Psr\Log\LoggerInterface', $logger);
    }

    public function testGetTestLogger()
    {
        $logger = $this->getTestLogger();
        $this->assertInstanceOf('\Gamez\Psr\Log\TestLogger', $logger);
    }
}
