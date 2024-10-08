<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Models\Shifts\Taxes;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class TaxesMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Taxes
    {
        if ($json === null) {
            return null;
        }

        $taxesArr = [];

        foreach ($json as $jsonRow) {
            $tax = (new TaxMapper)->jsonToObject($jsonRow);

            if (!is_null($tax)) {
                $taxesArr[] = $tax;
            }
        }

        return new Taxes($taxesArr);
    }
}
