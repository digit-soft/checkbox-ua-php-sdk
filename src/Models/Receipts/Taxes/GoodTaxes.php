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

    /**
     * Retrieve one tax by `label`.
     *
     * @param  string $label
     * @return \DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTax|null
     */
    public function getTaxByLabel(string $label): ?GoodTax
    {
        foreach ($this->results as $tax) {
            if ($tax->label === $label) {
                return $tax;
            }
        }

        return null;
    }

    /**
     * Retrieve taxes by `label`.
     *
     * @param  string $label
     * @return \DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes|null
     * @throws \Exception
     */
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

    /**
     * Retrieve one tax by `code`.
     *
     * @param  string $code
     * @return \DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTax|null
     */
    public function getTaxByCode(string $code): ?GoodTax
    {
        foreach ($this->results as $tax) {
            if ($tax->code === $code) {
                return $tax;
            }
        }

        return null;
    }

    /**
     * Retrieve taxes by `code`.
     *
     * @param  string $code
     * @return \DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes
     * @throws \Exception
     */
    public function getTaxesByCode(string $code): GoodTaxes
    {
        $taxes = array_filter($this->results, fn (GoodTax $tax) => $tax->code === $code);

        return new GoodTaxes(array_values($taxes));
    }
}
