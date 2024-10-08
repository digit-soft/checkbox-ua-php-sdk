<?php

namespace DigitSoft\Checkbox\Models\Receipts\Payments;

/**
 * @method static static make(string $value, string $label = 'Готівкою')
 */
class CashPaymentPayload extends PaymentParent
{
    public function __construct(
        string $value,
        string $label = 'Готівкою'
    ) {
        parent::__construct(parent::TYPE_CASH, $value, $label);
    }
}
