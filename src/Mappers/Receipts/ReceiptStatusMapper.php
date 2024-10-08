<?php

namespace DigitSoft\Checkbox\Mappers\Receipts;

use DigitSoft\Checkbox\Models\Receipts\ReceiptStatus;

class ReceiptStatusMapper
{
    /**
     * @param  string $json
     * @return ReceiptStatus|null
     */
    public function jsonToObject(mixed $json): ?ReceiptStatus
    {
        if ($json === null) {
            return null;
        }

        return new ReceiptStatus($json);
    }
}
