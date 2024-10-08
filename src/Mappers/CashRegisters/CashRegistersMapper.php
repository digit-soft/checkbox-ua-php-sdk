<?php

namespace DigitSoft\Checkbox\Mappers\CashRegisters;

use DigitSoft\Checkbox\Mappers\MetaMapper;
use DigitSoft\Checkbox\Models\CashRegisters\CashRegisters;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class CashRegistersMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?CashRegisters
    {
        if ($json === null) {
            return null;
        }

        $registersArr = [];

        foreach ($json['results'] as $jsonRow) {
            $registersArr[] = (new CashRegisterMapper)->jsonToObject($jsonRow);
        }

        $meta = (new MetaMapper)->jsonToObject($json['meta']);

        return CashRegisters::make($registersArr, $meta);
    }
}
