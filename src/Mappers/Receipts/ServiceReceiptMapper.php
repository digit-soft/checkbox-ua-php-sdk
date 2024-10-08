<?php

namespace DigitSoft\Checkbox\Mappers\Receipts;

use DigitSoft\Checkbox\Models\Receipts\ServiceReceipt;
use DigitSoft\Checkbox\Models\Receipts\Payments\PaymentParent;
use DigitSoft\Checkbox\Mappers\Receipts\Payments\CashPaymentMapper;

class ServiceReceiptMapper
{
    /**
     * @param  ServiceReceipt $receipt
     * @return array<string, array<string, int|string>|null>
     */
    public function objectToJson(ServiceReceipt $receipt): array
    {
        $payment = null;

        if ($receipt->payment->type == PaymentParent::TYPE_CASH) {
            $payment = (new CashPaymentMapper())->objectToJson($receipt->payment);
        } elseif ($receipt->payment->type == PaymentParent::TYPE_CARD) {
            $payment = (new CashPaymentMapper())->objectToJson($receipt->payment);
        }

        return [
            'payment' => $payment,
        ];
    }
}
