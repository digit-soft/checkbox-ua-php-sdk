<?php

namespace DigitSoft\Checkbox\Models\Receipts;

class ReceiptsQueryParams
{
    public ?string $fiscal_code;
    public ?string $serial;
    public bool $desc = false;
    public int $limit = 25;
    public int $offset = 0;

    public function __construct(
        ?string $fiscal_code = null,
        ?string $serial = null,
        bool $desc = false,
        int $limit = 25,
        int $offset = 0
    ) {
        $this->validateConstructorArguments($offset, $limit);

        $this->fiscal_code = $fiscal_code;
        $this->serial = $serial;
        $this->desc = $desc;
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
            throw new \Exception('Offset cant be lower then 0');
        }

        if ($limit > 1000) {
            throw new \Exception('Limit cant be more then 1000');
        }
    }
}
