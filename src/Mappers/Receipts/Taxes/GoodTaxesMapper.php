<?php

namespace DigitSoft\Checkbox\Mappers\Receipts\Taxes;

use DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes;

class GoodTaxesMapper
{
    /**
     * @param mixed $json
     * @return GoodTaxes|null
     */
    public function jsonToObject($json): ?GoodTaxes
    {
        if (is_null($json)) {
            return null;
        }

        $result = [];

        foreach ($json as $row) {
            $tax = (new GoodTaxMapper())->jsonToObject($row);

            if (!is_null($tax)) {
                $result[] = $tax;
            }
        }

        $taxes = new GoodTaxes($result);

        return $taxes;
    }
}
