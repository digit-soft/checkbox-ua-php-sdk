<?php

namespace DigitSoft\Checkbox\Models\Receipts\Payments;

use DigitSoft\Checkbox\Models\ModelBaseWithResultsList;

/**
 * @property CardPaymentPayload[]|CashPaymentPayload[] $results
 */
class Payments extends ModelBaseWithResultsList
{
    /**
     * Constructor.
     *
     * @param  CardPaymentPayload[]|CashPaymentPayload[] $payments
     * @throws \Exception
     */
    public function __construct(array $payments)
    {
        foreach ($payments as $payment) {
            if ($payment instanceof PaymentParent) {
                $this->results[] = $payment;
            }
        }

        if (count($payments) > 0 and count($this->results) === 0) {
            throw new \Exception('There\'s wrong payment classes payments');
        }
    }
}
