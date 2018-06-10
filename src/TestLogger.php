<?php

declare(strict_types=1);

namespace Gamez\Psr\Log;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class TestLogger implements LoggerInterface
{
    use LoggerTrait;

    /**
     * @var Log
     */
    public $log;

    public function __construct()
    {
        $this->log = new Log();
    }

    public function log($level, $message, array $context = [])
    {
        $this->log[] = Record::fromValues($level, $message, $context);
    }
}
