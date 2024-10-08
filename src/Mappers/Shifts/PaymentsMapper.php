<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Models\Shifts\Payments;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class PaymentsMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Payments
    {
        if ($json === null) {
            return null;
        }

        $paymentArr = [];

        foreach ($json as $jsonRow) {
            $payment = (new PaymentMapper())->jsonToObject($jsonRow);

            if (!is_null($payment)) {
                $paymentArr[] = $payment;
            }
        }

        return new Payments($paymentArr);
    }
}
