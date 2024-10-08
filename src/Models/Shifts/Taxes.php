<?php

namespace DigitSoft\Checkbox\Models\Shifts;

use DigitSoft\Checkbox\Models\ModelBase;

/**
 * @method static static make(array $taxes)
 */
class Taxes extends ModelBase
{
    /** @var Tax[] $taxes */
    public array $taxes;

    /**
     * Constructor
     *
     * @param Tax[] $taxes
     */
    public function __construct(array $taxes)
    {
        $this->taxes = $taxes;
    }
}
