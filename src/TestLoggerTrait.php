<?php

/*
 * This file is part of the PHP Test Logger package.
 *
 * Copyright (c) Jérôme Gamez <jerome@gamez.name>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gamez\Psr\Log;

/**
 * @method \PHPUnit_Framework_MockObject_MockBuilder getMockBuilder($className)
 */
trait TestLoggerTrait
{
    /**
     * @return \Psr\Log\LoggerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockLogger()
    {
        $mock = $this->getMockBuilder('\Psr\Log\LoggerInterface')
            ->getMock();

        return $mock;
    }

    /**
     * @return TestLogger
     */
    protected function getTestLogger()
    {
        return new TestLogger();
    }
}
