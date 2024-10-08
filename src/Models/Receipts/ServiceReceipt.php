<?php

namespace DigitSoft\Checkbox\Models\Receipts;

use DigitSoft\Checkbox\Models\ModelBase;
use DigitSoft\Checkbox\Models\Receipts\Payments\PaymentParent;

/**
 * @method static static make(PaymentParent $payment)
 */
class ServiceReceipt extends ModelBase
{
    public PaymentParent $payment;

    public function __construct(
        PaymentParent $payment
    ) {
        $this->payment = $payment;
    }
}
