<?php

namespace DigitSoft\Checkbox\Models;

use Traversable;

/**
 * Base class for models with a list of results and metadata (limit + offset).
 */
class ModelBaseWithResultsList extends ModelBase implements \IteratorAggregate
{
    public array $results = [];
    public ?Meta $meta = null;

    /**
     * {@inheritdoc}
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->results);
    }
}
