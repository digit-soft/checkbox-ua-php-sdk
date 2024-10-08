<?php

namespace DigitSoft\Checkbox\Mappers\CashRegisters;

use DigitSoft\Checkbox\Mappers\Shifts\ShiftMapper;
use DigitSoft\Checkbox\Models\CashRegisters\CashRegister;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class CashRegisterMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?CashRegister
    {
        if ($json === null) {
            return null;
        }

        $shift = (new ShiftMapper)->jsonToObject($json['shift'] ?? null);

        return CashRegister::make(
            $json['id'],
            $json['fiscal_number'],
            $json['created_at'],
            $json['updated_at'],
            $shift,
            $json['offline_mode'] ?? null
        );
    }
}
