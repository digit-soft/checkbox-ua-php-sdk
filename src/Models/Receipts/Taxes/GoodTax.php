<?php

namespace DigitSoft\Checkbox\Models\Receipts\Taxes;

class GoodTax
{
    public string $id;
    public string $code;
    public string $label;
    public string $symbol;
    public int $rate;
    public ?int $extra_rate;
    public float $decimal_rate;
    public ?float $decimal_extra_rate;
    public bool $included;
    public bool $no_vat;
    public string $created_at;
    public ?string $updated_at;

    public function __construct(
        string $id,
        string $code,
        string $label,
        string $symbol,
        float $rate,
        ?float $extra_rate,
        float $decimal_rate,
        ?float $decimal_extra_rate,
        bool $included,
        bool $no_vat,
        string $created_at,
        ?string $updated_at = null
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->label = $label;
        $this->symbol = $symbol;
        $this->rate = $rate;
        $this->extra_rate = $extra_rate;
        $this->included = $included;
        $this->no_vat = $no_vat;
        $this->decimal_rate = $decimal_rate;
        $this->decimal_extra_rate = $decimal_extra_rate;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
