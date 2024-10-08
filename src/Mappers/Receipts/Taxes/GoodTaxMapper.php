<?php

namespace DigitSoft\Checkbox\Mappers\Receipts\Taxes;

use DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTax;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class GoodTaxMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?GoodTax
    {
        if ($json === null) {
            return null;
        }

        return new GoodTax(
            $json['id'],
            $json['code'],
            $json['label'],
            $json['symbol'],
            $json['rate'] ?? 0,
            $json['extra_rate'] ?? null,
            $json['decimal_rate'] ?? 0.0,
            $json['decimal_extra_rate'] ?? null,
            $json['included'] ?? true,
            $json['no_vat'] ?? true,
            $json['created_at'],
            $json['updated_at'] ?? null,
        );
    }
}
