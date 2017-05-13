<?php

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

    /**
     * @deprecated 2.0.0
     */
    public function getRecords(): array
    {
        return array_map(function (Record $record) {
            return sprintf('%s %s', $record->level, $record->message);
        }, $this->log->getItems());
    }

    /**
     * @deprecated 2.0.0
     */
    public function hasRecord($needle): bool
    {
        return (bool) count(array_filter($this->getRecords(), function ($message) use ($needle) {
            return stripos($message, $needle) !== false;
        }));
    }
}
