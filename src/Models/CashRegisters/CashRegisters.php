<?php

namespace DigitSoft\Checkbox\Models\CashRegisters;

use DigitSoft\Checkbox\Models\Meta;
use DigitSoft\Checkbox\Models\ModelBaseWithResultsList;

/**
 * @property \DigitSoft\Checkbox\Models\CashRegisters\CashRegister[]|array $results
 * @method static static make(array $shifts, ?Meta $meta = null)
 */
class CashRegisters extends ModelBaseWithResultsList
{
    /**
     * Constructor.
     *
     * @param  CashRegister[] $cashRegisters
     * @param  Meta|null      $meta
     * @noinspection PhpDynamicFieldDeclarationInspection
     */
    public function __construct(array $cashRegisters, ?Meta $meta = null)
    {
        $this->results = $cashRegisters;
        $this->meta = $meta;
    }
}
