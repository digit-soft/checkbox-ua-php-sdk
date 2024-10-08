<?php

namespace DigitSoft\Checkbox\Models\Receipts;

use DigitSoft\Checkbox\Models\ModelBase;
use DigitSoft\Checkbox\Models\Receipts\Goods\Goods;
use DigitSoft\Checkbox\Models\Receipts\Payments\Payments;
use DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts;

class SellReceipt extends ModelBase
{
    /** @var string $cashier_name */
    public string $cashier_name;
    /** @var string $departament */
    public string $departament;
    /** @var Goods $goods */
    public Goods $goods;
    /** @var Delivery $delivery */
    public Delivery $delivery;
    /** @var Discounts|null $discounts */
    public ?Discounts $discounts;
    /** @var Payments $payments */
    public Payments $payments;
    /** @var string $header */
    public string $header;
    /** @var string $footer */
    public string $footer;
    /** @var string $barcode */
    public string $barcode;
    /**
     * How to use id, check official documentation
     *
     * @see https://docs.google.com/document/d/1Zhkc4OljKjea_235YafVvZunkWSp6TCAKeckhgl8t2w/edit#heading=h.prhyp31urzzb
     * @var string|null
     */
    public ?string $id;
    public ?string $related_receipt_id;

    public function __construct(
        string $cashier_name,
        string $departament,
        Goods $goods,
        Delivery $delivery,
        Payments $payments,
        ?Discounts $discounts = null,
        string $header = '',
        string $footer = '',
        string $barcode = '',
        ?string $id = null,
        ?string $related_receipt_id = null
    ) {
        $this->id = $id;
        $this->cashier_name = $cashier_name;
        $this->departament = $departament;
        $this->goods = $goods;
        $this->delivery = $delivery;
        $this->discounts = $discounts;
        $this->payments = $payments;
        $this->header = $header;
        $this->footer = $footer;
        $this->barcode = $barcode;
        $this->related_receipt_id = $related_receipt_id;
    }
}
