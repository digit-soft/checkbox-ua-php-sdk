<?php

namespace DigitSoft\Checkbox\Models\CashRegisters;

class CashRegistersQueryParams
{
    public ?bool $inUse; // null, true, false
    public int $limit;
    public int $offset;

    public function __construct(
        ?bool $inUse = null,
        int $limit = 25,
        int $offset = 0
    ) {
        $this->validateConstructorArguments($offset, $limit);

        $this->inUse = $inUse;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * Validate some constructor arguments.
     *
     * @param  int $offset
     * @param  int $limit
     * @return void
     * @throws \Exception
     */
    public function validateConstructorArguments(int $offset, int $limit): void
    {
        if ($offset < 0) {
            throw new \Exception("Offset can't be less than 0");
        }

        if ($limit > 1000) {
            throw new \Exception("Limit can't be greater than 1000");
        }
    }
}
