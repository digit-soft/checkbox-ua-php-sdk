<?php

namespace DigitSoft\Checkbox\Models\Receipts\Discounts;

use DigitSoft\Checkbox\Models\ModelBaseWithResultsList;

/**
 * @property \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel[] $results
 */
class Discounts extends ModelBaseWithResultsList
{
    /**
     * Constructor.
     *
     * @param  array<DiscountModel> $discounts
     * @throws \Exception
     */
    public function __construct(array $discounts)
    {
        foreach ($discounts as $discount) {
            if (! $discount instanceof DiscountModel) {
                throw new \Exception('Discount has a wrong class');
            }

            $this->results[] = $discount;
        }
    }
}
