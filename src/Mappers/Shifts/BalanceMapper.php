<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Models\Shifts\Balance;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class BalanceMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Balance
    {
        if ($json === null) {
            return null;
        }

        return new Balance(
            $json['initial'],
            $json['balance'],
            $json['cash_sales'],
            $json['card_sales'],
            $json['cash_returns'],
            $json['card_returns'],
            $json['service_in'],
            $json['service_out'],
            $json['discounts_sum'] ?? null,
            $json['extra_charge_sum'] ?? null,
            $json['updated_at'] ?? null
        );
    }
}
