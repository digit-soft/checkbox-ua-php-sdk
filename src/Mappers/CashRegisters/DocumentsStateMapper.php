<?php

namespace DigitSoft\Checkbox\Mappers\CashRegisters;

use DigitSoft\Checkbox\Models\CashRegisters\DocumentsState;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class DocumentsStateMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?DocumentsState
    {
        if ($json === null) {
            return null;
        }

        return new DocumentsState(
            $json['last_receipt_code'],
            $json['last_report_code'],
            $json['last_z_report_code']
        );
    }
}
