<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Mappers\MetaMapper;
use DigitSoft\Checkbox\Models\Shifts\Shifts;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class ShiftsMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Shifts
    {
        if ($json === null) {
            return null;
        }

        $shiftsArr = [];
        foreach ($json['results'] as $jsonRow) {
            if (($shift = (new ShiftMapper)->jsonToObject($jsonRow)) !== null) {
                $shiftsArr[] = $shift;
            }
        }

        $meta = (new MetaMapper)->jsonToObject($json['meta'] ?? null);

        return Shifts::make($shiftsArr, $meta);
    }
}
