<?php

declare(strict_types=1);

namespace Gamez\Psr\Log;

use JsonSerializable;

/**
 * @see https://www.php-fig.org/psr/psr-3/#13-context
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
        return (bool) \count($this->values);
    }

    public function jsonSerialize()
    {
        return $this->values;
    }
}
