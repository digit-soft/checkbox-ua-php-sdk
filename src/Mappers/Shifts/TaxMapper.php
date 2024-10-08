<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Models\Shifts\Tax;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class TaxMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Tax
    {
        if ($json === null) {
            return null;
        }

        return Tax::make(
            $json['id'],
            $json['code'],
            $json['label'],
            $json['symbol'],
            $json['rate'],
            $json['extra_rate'] ?? null,
            $json['included'] ?? false,
            $json['no_vat'] ?? false,
            $json['created_at'],
            $json['updated_at'] ?? null,
            $json['sales'] ?? 0,
            $json['returns'] ?? 0,
            $json['sales_turnover'],
            $json['returns_turnover']
        );
    }
}
