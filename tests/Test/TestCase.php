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

class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function getLogLevels()
    {
        $rc = new \ReflectionClass('\Psr\Log\LogLevel');

        return $rc->getConstants();
    }

    public function logLevelProvider()
    {
        $levels = $this->getLogLevels();

        array_walk($levels, function (&$level) {
            $level = [$level];
        });

        return $levels;
    }

    public function messageProvider()
    {
        $levels = $this->getLogLevels();

        array_walk($levels, function (&$level) {
            $level = [$level, $level, ['context_level' => $level]];
        });

        return $levels;
    }
}
