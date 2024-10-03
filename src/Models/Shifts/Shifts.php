<?php

namespace DigitSoft\Checkbox\Models\Shifts;

use DigitSoft\Checkbox\Models\Meta;

class Shifts
{
    /** @var array<Shift> $results */
    public $results;
    /** @var Meta|null $meta */
    public $meta;

    /**
     * Constructor
     *
     * @param array<Shift> $shifts
     * @param Meta|null $meta
     *
     */
    public function __construct(array $shifts, ?Meta $meta)
    {
        $this->results = $shifts;
        $this->meta = $meta;
    }
}
