<?php

namespace DigitSoft\Checkbox\Models\CashRegisters;

use DigitSoft\Checkbox\Models\ModelBase;
use DigitSoft\Checkbox\Models\Shifts\Shift;

/**
 * @method static static make(string $id, string $fiscal_number, string $created_at, string $updated_at, ?Shift $shift, ?bool $offline_mode = false)
 */
class CashRegister extends ModelBase
{
    public string $id;
    public string $fiscal_number;
    public string $created_at;
    public string $updated_at;
    public ?Shift $shift;
    public ?bool $offline_mode;

    public function __construct(
        string $id,
        string $fiscal_number,
        string $created_at,
        string $updated_at,
        ?Shift $shift,
        ?bool $offline_mode = false
    ) {
        $this->id = $id;
        $this->fiscal_number = $fiscal_number;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->shift = $shift;
        $this->offline_mode = $offline_mode;
    }
}
