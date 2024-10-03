<?php

namespace DigitSoft\Checkbox\Models\CashRegisters;

class CashRegistersQueryParams
{
    /** @var bool|null $inUse */
    public $inUse; // null, true, false
    /** @var int $limit */
    public $limit;
    /** @var int $offset */
    public $offset;

    public function __construct(
        ?bool $inUse = null,
        int $limit = 25,
        int $offset = 0
    ) {
        if ($offset < 0) {
            throw new \Exception('Offset cant be lower then 0');
        }

        if ($limit > 1000) {
            throw new \Exception('Limit cant be more then 1000');
        }

        $this->inUse = $inUse;
        $this->offset = $offset;
        $this->limit = $limit;
    }
}
