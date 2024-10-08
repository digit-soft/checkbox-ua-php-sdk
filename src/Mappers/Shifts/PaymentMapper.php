<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Models\Shifts\Payment;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class PaymentMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Payment
    {
        if ($json === null) {
            return null;
        }

        return new Payment(
            $json['id'],
            $json['type'],
            $json['label'],
            $json['sell_sum'],
            $json['return_sum'],
            $json['service_in'],
            $json['service_out']
        );
    }
}
