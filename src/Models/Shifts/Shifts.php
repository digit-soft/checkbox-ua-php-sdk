<?php

namespace DigitSoft\Checkbox\Models\Shifts;

use DigitSoft\Checkbox\Models\Meta;
use DigitSoft\Checkbox\Models\ModelBaseWithResultsList;

/**
 * @property \DigitSoft\Checkbox\Models\Shifts\Shift[]|array $results
 * @method static static make(array $shifts, ?Meta $meta = null)
 */
class Shifts extends ModelBaseWithResultsList
{
    /**
     * Constructor
     *
     * @param  Shift[]   $shifts
     * @param  Meta|null $meta
     * @noinspection PhpDynamicFieldDeclarationInspection
     */
    public function __construct(array $shifts, ?Meta $meta = null)
    {
        $this->results = $shifts;
        $this->meta = $meta;
    }
}
