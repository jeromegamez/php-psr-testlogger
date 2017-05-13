<?php

namespace Gamez\Psr\Log;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;

interface Collection extends ArrayAccess, Countable, IteratorAggregate, JsonSerializable
{
    /**
     * Returns a new collection with items filtered by the given callback.
     *
     * @param callable $callback
     *
     * @return static|Collection
     */
    public function filter(callable $callback);

    /**
     * Returns the items of the current collection.
     *
     * @return array
     */
    public function getItems(): array;
}
