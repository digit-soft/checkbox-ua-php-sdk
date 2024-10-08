<?php

namespace DigitSoft\Checkbox\Mappers\Receipts;

use DigitSoft\Checkbox\Models\Receipts\ReceiptTypes;

class ReceiptTypeMapper
{
    /**
     * @param  string $json
     * @return ReceiptTypes|null
     */
    public function jsonToObject(mixed $json): ?ReceiptTypes
    {
        if ($json === null) {
            return null;
        }

        return new ReceiptTypes($json);
    }
}
