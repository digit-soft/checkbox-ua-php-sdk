<?php

namespace DigitSoft\Checkbox\Models\Shifts;

use DigitSoft\Checkbox\Models\ModelBase;

/**
 * @method static static make(string $initial, string $balance, string $cash_sales, string $card_sales, string $cash_returns, string $card_returns, string $service_in, string $service_out, ?int $discounts_sum = null, ?int $extra_charge_sum = null, ?string $updated_at = null)
 */
class Balance extends ModelBase
{
    public int $initial;
    public int $balance;
    public int $cash_sales;
    public int $card_sales;
    public int $cash_returns;
    public int $card_returns;
    public int $service_in;
    public int $service_out;
    public ?int $discounts_sum;
    public ?int $extra_charge_sum;
    public ?string $updated_at;

    public function __construct(
        string $initial,
        string $balance,
        string $cash_sales,
        string $card_sales,
        string $cash_returns,
        string $card_returns,
        string $service_in,
        string $service_out,
        ?int $discounts_sum = null,
        ?int $extra_charge_sum = null,
        ?string $updated_at = null
    ) {
        $this->initial = $initial;
        $this->balance = $balance;
        $this->cash_sales = $cash_sales;
        $this->card_sales = $card_sales;
        $this->cash_returns = $cash_returns;
        $this->card_returns = $card_returns;
        $this->service_in = $service_in;
        $this->service_out = $service_out;
        $this->discounts_sum = $discounts_sum;
        $this->extra_charge_sum = $extra_charge_sum;
        $this->updated_at = $updated_at;
    }
}
