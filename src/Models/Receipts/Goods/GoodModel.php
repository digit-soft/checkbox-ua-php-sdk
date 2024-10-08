<?php

namespace DigitSoft\Checkbox\Models\Receipts\Goods;

use DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes;

class GoodModel
{
    public string $code;
    public string $name;
    public ?string $barcode;
    public ?string $uktzed;
    public ?string $header;
    public ?string $footer;
    public int $price;
    public ?GoodTaxes $taxes;

    public function __construct(
        string $code,
        int $price,
        string $name,
        ?string $barcode = null,
        ?string $header = null,
        ?string $footer = null,
        ?string $uktzed = null,
        ?GoodTaxes $taxes = null
    ) {
        $this->code = $code;
        $this->price = $price;
        $this->name = $name;
        $this->barcode = $barcode;
        $this->header = $header;
        $this->footer = $footer;
        $this->uktzed = $uktzed;
        $this->taxes = $taxes;
    }
}
