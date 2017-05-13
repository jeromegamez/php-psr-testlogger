<?php

namespace Gamez\Psr\Log;

class Log extends InMemoryCollection
{
    public function has($value): bool
    {
        return $this->hasRecordsWithLevel($value)
            || $this->hasRecordsWithPartialMessage($value);
    }

    public function onlyMessasagesWithUnreplacedPlaceholders(): Log
    {
        return $this->filter(function (Record $record) {
            return $record->message->hasPlaceholders();
        });
    }

    public function countRecordsWithUnreplacedPlaceholders(): int
    {
        return $this->onlyMessasagesWithUnreplacedPlaceholders()->count();
    }

    public function hasRecordsWithUnreplacedPlaceholders(): bool
    {
        return (bool) $this->countRecordsWithUnreplacedPlaceholders();
    }

    public function onlyWithLevel($level): Log
    {
        return $this->filter(function (Record $record) use ($level) {
            return $record->level->value === $level;
        });
    }

    public function countRecordsWithLevel($level): int
    {
        return $this->onlyWithLevel($level)->count();
    }

    public function hasRecordsWithLevel($level): bool
    {
        return (bool) $this->countRecordsWithLevel($level);
    }

    public function onlyWithMessage($message): Log
    {
        return $this->filter(function (Record $record) use ($message) {
            return $record->message->value === $message;
        });
    }

    public function countRecordsWithMessage($message): bool
    {
        return $this->onlyWithMessage($message)->count();
    }

    public function hasRecordsWithMessage($message): bool
    {
        return (bool) $this->countRecordsWithMessage($message);
    }

    public function onlyMatchingPartialMessage($message): Log
    {
        return $this->filter(function (Record $record) use ($message) {
            return mb_strpos($record->message->value, $message) !== false;
        });
    }

    public function countRecordsWithPartialMessage($message): bool
    {
        return $this->onlyMatchingPartialMessage($message)->count();
    }

    public function hasRecordsWithPartialMessage($message): bool
    {
        return (bool) $this->countRecordsWithPartialMessage($message);
    }

    public function onlyWithContextKey($key): Log
    {
        return $this->filter(function (Record $record) use ($key) {
            return $record->context->has($key);
        });
    }

    public function countRecordsWithContextKey($key): bool
    {
        return $this->onlyWithContextKey($key)->count();
    }

    public function hasRecordsWithContextKey(string $key): bool
    {
        return (bool) $this->countRecordsWithContextKey($key);
    }

    public function onlyWithContextKeyAndValue($key, $value): Log
    {
        return $this->filter(function (Record $record) use ($key, $value) {
            return $record->context->get($key) === $value;
        });
    }

    public function countRecordsWithContextKeyAndValue($key, $value): bool
    {
        return $this->onlyWithContextKeyAndValue($key, $value)->count();
    }

    public function hasRecordsWithContextKeyAndValue($key, $value): bool
    {
        return (bool) $this->countRecordsWithContextKeyAndValue($key, $value);
    }
}
