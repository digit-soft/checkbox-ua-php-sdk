<?php

namespace DigitSoft\Checkbox\Models;

abstract class ModelBase
{
    /**
     * Make a new instance of the model.
     *
     * @param ...$params
     * @return static
     */
    public static function make(...$params): static
    {
        return new static(...$params);
    }
}
