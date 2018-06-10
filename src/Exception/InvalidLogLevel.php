<?php

declare(strict_types=1);

namespace Gamez\Psr\Log\Exception;

use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel;

class InvalidLogLevel extends InvalidArgumentException
{
    /**
     * @var string
     */
    public $level;

    /**
     * @var string[]
     */
    public $validLevels;

    public function __construct(string $level)
    {
        $this->level = $level;
        $this->validLevels = (new \ReflectionClass(LogLevel::class))->getConstants();

        $message = sprintf('The level "%s" is invalid, please use one of: "%s"',
            $this->level, implode('", "', $this->validLevels)
        );

        parent::__construct($message);
    }
}
