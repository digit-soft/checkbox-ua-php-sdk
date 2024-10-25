<?php

namespace DigitSoft\Checkbox\Mappers\Receipts\Payments;

use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;
use DigitSoft\Checkbox\Models\Receipts\Payments\PaymentParent;
use DigitSoft\Checkbox\Models\Receipts\Payments\CardPaymentPayload;

class CardPaymentMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?CardPaymentPayload
    {
        if (is_null($json)) {
            return null;
        }

        return new CardPaymentPayload(
            $json['value'],
            $json['label'] ?? null,
            $json['code'] ?? 0,
            $json['card_mask'] ?? '0000 0000 0000 0000',
            $json['terminal'] ?? null,
            $json['bank_name'] ?? null,
            $json['rrn'] ?? null,
            $json['card_name'] ?? null,
            $json['auth_code'] ?? null,
            $json['payment_system'] ?? null,
            $json['receipt_no'] ?? null,
            $json['acquirer_and_seller'] ?? null,
            $json['transaction_id'] ?? null,
            $json['commission'] ?? 0,
        );
    }

    /**
     * @param PaymentParent $obj
     * @return array<string, mixed>
     */
    public function objectToJson(PaymentParent $obj)
    {
        $result = [
            'type' => $obj->type,
            'value' => $obj->value,
        ];

        if (! empty($obj->code)) {
            $result['code'] = $obj->code;
        }

        if (! empty($obj->label)) {
            $result['label'] = $obj->label;
        }

        if (isset($obj->card_mask)) {
            $result['card_mask'] = $obj->card_mask;
        }

        if (isset($obj->bank_name)) {
            $result['bank_name'] = $obj->bank_name;
        }

        if (isset($obj->auth_code)) {
            $result['auth_code'] = $obj->auth_code;
        }

        if (isset($obj->rrn)) {
            $result['rrn'] = $obj->rrn;
        }

        if (isset($obj->payment_system)) {
            $result['payment_system'] = $obj->payment_system;
        }

        if (isset($obj->terminal)) {
            $result['terminal'] = $obj->terminal;
        }

        if (isset($obj->acquirer_and_seller)) {
            $result['acquirer_and_seller'] = $obj->acquirer_and_seller;
        }

        if (isset($obj->transaction_id)) {
            $result['transaction_id'] = $obj->transaction_id;
        }

        if (isset($obj->receipt_no)) {
            $result['receipt_no'] = $obj->receipt_no;
        }

        if (isset($obj->commission)) {
            $result['commission'] = $obj->commission;
        }

        return $result;
    }
}
