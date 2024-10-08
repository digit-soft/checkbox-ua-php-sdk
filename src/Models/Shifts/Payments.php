<?php

namespace DigitSoft\Checkbox\Models\Shifts;

use DigitSoft\Checkbox\Models\ModelBase;

class Payments extends ModelBase
{
    /** @var Payment[] */
    public array $payments;

    /**
     * Constructor
     *
     * @param Payment[] $payments
     */
    public function __construct(array $payments)
    {
        $this->payments = $payments;
    }
}
