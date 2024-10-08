<?php

namespace DigitSoft\Checkbox\Models\Shifts;

use DigitSoft\Checkbox\Models\ModelBase;

/**
 * @method static static make(string $id, int $code, string $label, string $symbol, int $rate, ?float $extra_rate, bool $included, bool $no_vat, string $created_at, ?string $updated_at, int $sales, int $returns, int $sales_turnover, int $returns_turnover)
 */
class Tax extends ModelBase
{
    public string $id;
    public int $code;
    public string $label;
    public string $symbol;
    public int $rate;
    public ?float $extra_rate;
    public bool $included;
    public bool $no_vat;
    public string $created_at;
    public ?string $updated_at;
    public int $sales;
    public int $returns;
    public int $sales_turnover;
    public int $returns_turnover;

    public function __construct(
        string $id,
        int $code,
        string $label,
        string $symbol,
        int $rate,
        ?float $extra_rate,
        bool $included,
        bool $no_vat,
        string $created_at,
        ?string $updated_at,
        int $sales,
        int $returns,
        int $sales_turnover,
        int $returns_turnover
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->label = $label;
        $this->symbol = $symbol;
        $this->rate = $rate;
        $this->extra_rate = $extra_rate;
        $this->included = $included;
        $this->no_vat = $no_vat;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->sales = $sales;
        $this->returns = $returns;
        $this->sales_turnover = $sales_turnover;
        $this->returns_turnover = $returns_turnover;
    }
}
