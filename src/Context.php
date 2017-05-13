<?php

namespace Gamez\Psr\Log;

use JsonSerializable;

/**
 * @see http://www.php-fig.org/psr/psr-3/#context
 */
class Context implements JsonSerializable
{
    /**
     * @var array
     */
    public $values;

    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    public function has($key): bool
    {
        return array_key_exists($key, $this->values);
    }

    public function get($key)
    {
        return $this->values[$key] ?? null;
    }

    public function isEmpty(): bool
    {
        return (bool) count($this->values);
    }

    public function jsonSerialize()
    {
        return $this->values;
    }
}
