<?php

namespace DigitSoft\Checkbox\Models\Receipts\Goods;

use DigitSoft\Checkbox\Models\ModelBase;

class Goods extends ModelBase
{
    /** @var GoodItemModel[] $results */
    public array $results;

    /**
     * Constructor
     *
     * @param GoodItemModel[] $goods
     *
     */
    public function __construct(array $goods)
    {
        $this->results = $goods;
    }
}
