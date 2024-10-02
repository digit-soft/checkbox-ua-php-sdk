<?php

namespace DigitSoft\Checkbox\Models\Receipts;

use DigitSoft\Checkbox\Models\Receipts\Payments\PaymentParent;

class ServiceReceipt
{
    /** @var PaymentParent $payment */
    public $payment;

    public function __construct(
        PaymentParent $payment
    ) {
        $this->payment = $payment;
    }
}
