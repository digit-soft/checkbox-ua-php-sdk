<?php

namespace DigitSoft\Checkbox\Mappers\Receipts\Taxes;

use DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class GoodTaxesMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?GoodTaxes
    {
        if ($json === null) {
            return null;
        }

        $result = [];

        foreach ($json as $row) {
            $tax = (new GoodTaxMapper)->jsonToObject($row);

            if (!is_null($tax)) {
                $result[] = $tax;
            }
        }

        return new GoodTaxes($result);
    }
}
