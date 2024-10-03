<?php

namespace DigitSoft\Checkbox\Mappers\Receipts\Payments;

use DigitSoft\Checkbox\Models\Receipts\Payments\PaymentParent;
use DigitSoft\Checkbox\Models\Receipts\Payments\Payments;

class PaymentsMapper
{
    /**
     * @param mixed $json
     * @return Payments|null
     */
    public function jsonToObject($json): ?Payments
    {
        if (is_null($json)) {
            return null;
        }

        $results = [];

        foreach ($json as $payment) {
            if ($payment['type'] == PaymentParent::TYPE_CASH) {
                $pay = (new CashPaymentMapper())->jsonToObject($payment);

                if (!is_null($pay)) {
                    $results[] = $pay;
                }
            } elseif ($payment['type'] == PaymentParent::TYPE_CARD) {
                $pay = (new CardPaymentMapper())->jsonToObject($payment);

                if (!is_null($pay)) {
                    $results[] = $pay;
                }
            }
        }

        $receipt = new Payments($results);

        return $receipt;
    }

    /**
     * @param Payments $payments
     * @return array<mixed>
     */
    public function objectToJson(Payments $payments): array
    {
        $results = [];

        foreach ($payments->results as $payment) {
            if ($payment->type == PaymentParent::TYPE_CASH) {
                $results[] = (new CashPaymentMapper())->objectToJson($payment);
            } elseif ($payment->type == PaymentParent::TYPE_CARD) {
                $results[] = (new CardPaymentMapper())->objectToJson($payment);
            }
        }

        return $results;
    }
}
