<?php

namespace DigitSoft\Checkbox\Mappers\Receipts;

use DigitSoft\Checkbox\Models\Receipts\ReceiptStatus;

class ReceiptStatusMapper
{
    /**
     * @param mixed $json
     * @return ReceiptStatus|null
     */
    public function jsonToObject($json): ?ReceiptStatus
    {
        if (is_null($json)) {
            return null;
        }

        $receipt = new ReceiptStatus($json);

        return $receipt;
    }
}
