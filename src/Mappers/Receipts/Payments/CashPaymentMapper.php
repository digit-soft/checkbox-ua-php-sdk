<?php

namespace DigitSoft\Checkbox\Mappers\Receipts\Payments;

use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;
use DigitSoft\Checkbox\Models\Receipts\Payments\CashPaymentPayload;
use DigitSoft\Checkbox\Models\Receipts\Payments\PaymentParent;

class CashPaymentMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?CashPaymentPayload
    {
        if ($json === null) {
            return null;
        }

        return new CashPaymentPayload(
            $json['value'],
            $json['label'] ?? ''
        );
    }

    /**
     * @param PaymentParent $obj
     * @return array<string, int|string>
     */
    public function objectToJson(PaymentParent $obj): array
    {
        $result = [
            'type' => $obj->type,
            'value' => $obj->value
        ];

        if (!empty($obj->label)) {
            $result['label'] = $obj->label;
        }

        return $result;
    }
}
