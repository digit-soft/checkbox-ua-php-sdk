<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Models\Shifts\Tax;

class TaxMapper
{
    /**
     * @param mixed $json
     * @return Tax|null
     */
    public function jsonToObject($json): ?Tax
    {
        if (is_null($json)) {
            return null;
        }

        $tax = new Tax(
            $json['id'],
            $json['code'],
            $json['label'],
            $json['symbol'],
            $json['rate'],
            $json['extra_rate'] ?? '',
            $json['included'] ?? '',
            $json['created_at'],
            $json['updated_at'] ?? '',
            $json['sales'] ?? '',
            $json['returns'] ?? '',
            $json['sales_turnover'],
            $json['returns_turnover']
        );

        return $tax;
    }
}
