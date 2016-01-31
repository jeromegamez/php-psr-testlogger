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

use Psr\Log\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class TestLogger implements LoggerInterface
{
    use LoggerTrait;

    /**
     * @var string[]
     */
    private $records;

    /**
     * @var string[]
     */
    private $allowedLevels;

    /**
     * @var bool
     */
    private $allowNonPsrLevels;

    public function __construct()
    {
        $this->records = [];
        $this->allowedLevels = $this->getAllowedLevels();
        $this->allowNonPsrLevels = false;
    }

    public function log($level, $message, array $context = [])
    {
        if (!$this->allowNonPsrLevels && !in_array($level, $this->allowedLevels, true)) {
            throw new InvalidArgumentException(
                sprintf('Invalid level "%s", please use one of: %s', $level, implode(',', $this->allowedLevels))
            );
        }

        $record = sprintf('%s %s', strtolower($level), $message);

        foreach ($context as $key => $value) {
            if (!is_array($value) && (!is_object($value) || method_exists($value, '__toString'))) {
                $record = str_ireplace('{'.$key.'}', $value, $record);
            }
        }

        $this->records[] = $record;
    }

    /**
     * Returns all log messages.
     *
     * @return string[]
     */
    public function getRecords()
    {
        return $this->records;
    }

    /**
     * Checks whether a record with the given (partial) message exists.
     *
     * @param string $needle
     *
     * @return bool
     */
    public function hasRecord($needle)
    {
        foreach ($this->records as $message) {
            if (stripos($message, $needle) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Enables the logger to accept non-PSR-3 log levels.
     *
     * @param bool|null $allowNonPsrLevels
     */
    public function allowNonPsrLevels($allowNonPsrLevels = true)
    {
        $this->allowNonPsrLevels = $allowNonPsrLevels;
    }

    private function getAllowedLevels()
    {
        $rc = new \ReflectionClass('\Psr\Log\LogLevel');
        $levels = $rc->getConstants();

        return $levels;
    }
}
