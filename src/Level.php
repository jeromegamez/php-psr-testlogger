<?php

declare(strict_types=1);

namespace Gamez\Psr\Log;

use Gamez\Psr\Log\Exception\InvalidLogLevel;
use Psr\Log\LogLevel;

/**
 * @see
 */
class Level
{
    /**
     * @var string
     */
    public $value;

    public function __construct(string $value)
    {
        if (!in_array($value, (new \ReflectionClass(LogLevel::class))->getConstants())) {
            throw new InvalidLogLevel($value);
        }

        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
