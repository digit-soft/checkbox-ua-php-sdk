<?php

namespace DigitSoft\Checkbox\Mappers\Receipts;

use DigitSoft\Checkbox\Models\Receipts\Delivery;

class DeliveryMapper
{
    /**
     * @param  Delivery $delivery
     * @return array
     */
    public function objectToJson(Delivery $delivery): array
    {
        $output = [];

        if (! empty($delivery->emails())) {
            $output['emails'] = $delivery->emails();
        }

        if (! empty($delivery->phone())) {
            $output['phone'] = $delivery->phone();
        }

        return $output;
    }
}
