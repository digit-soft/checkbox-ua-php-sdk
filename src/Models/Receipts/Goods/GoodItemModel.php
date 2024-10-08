<?php

namespace DigitSoft\Checkbox\Models\Receipts\Goods;

use DigitSoft\Checkbox\Models\ModelBase;
use DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes;
use DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts;

class GoodItemModel extends ModelBase
{
    public ?GoodModel $good;
    public ?string $good_id;
    public int $sum;
    public int $quantity;
    public bool $is_return;
    public ?GoodTaxes $taxes;
    public ?Discounts $discounts;

    public function __construct(
        ?GoodModel $good,
        int $quantity,
        ?Discounts $discounts = null,
        ?GoodTaxes $taxes = null,
        bool $is_return = false,
        int $sum = 0,
        ?string $good_id = null
    ) {
        $this->good = $good;
        $this->sum = $sum;
        $this->quantity = $quantity;
        $this->is_return = $is_return;
        $this->taxes = $taxes;
        $this->good_id = $good_id;
        $this->discounts = $discounts;
    }
}
