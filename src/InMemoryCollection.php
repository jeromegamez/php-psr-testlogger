<?php

declare(strict_types=1);

namespace Gamez\Psr\Log;

use ArrayIterator;

class InMemoryCollection implements Collection
{
    /**
     * @var array
     */
    private $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function filter(callable $callback)
    {
        return new static(array_filter($this->items, $callback));
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if (null !== $offset) {
            $this->items[$offset] = $value;
        } else {
            $this->items[] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    public function count(): int
    {
        return \count($this->items);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    public function jsonSerialize()
    {
        return $this->items;
    }
}
