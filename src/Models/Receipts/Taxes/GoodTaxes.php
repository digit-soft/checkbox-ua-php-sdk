<?php

namespace DigitSoft\Checkbox\Models\Receipts\Taxes;

class GoodTaxes
{
    /** @var GoodTax[] */
    public array $results = [];

    /**
     * Constructor
     *
     * @param  array<GoodTax> $taxes
     * @throws \Exception
     */
    public function __construct(array $taxes)
    {
        foreach ($taxes as $tax) {
            if (!  $tax instanceof GoodTax) {
                throw new \Exception('Tax has wrong class');
            }

            $this->results[] = $tax;
        }
    }

    public function getTaxByLabel(string $label): ?GoodTax
    {
        foreach ($this->results as $tax) {
            if ($tax->label === $label) {
                return $tax;
            }
        }

        return null;
    }

    public function getTaxesByLabel(string $label): ?GoodTaxes
    {
        $taxesArr = [];

        foreach ($this->results as $tax) {
            if ($tax->label === $label) {
                $taxesArr[] = $tax;
            }
        }

        return new GoodTaxes($taxesArr);
    }
}
