<?php

namespace DigitSoft\Checkbox\Models\Receipts;

use DigitSoft\Checkbox\Models\ModelBase;
use DigitSoft\Checkbox\Models\Shifts\Shift;
use DigitSoft\Checkbox\Models\Receipts\Goods\Goods;
use DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes;
use DigitSoft\Checkbox\Models\Transactions\Transaction;
use DigitSoft\Checkbox\Models\Receipts\Payments\Payments;
use DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts;

class Receipt extends ModelBase
{
    public string $id;
    public int $serial;
    public ?ReceiptTypes $type;
    public ?Transaction $transaction;
    public ?ReceiptStatus $status;
    public ?Goods $goods;
    public ?Payments $payments;
    public ?GoodTaxes $taxes;
    public ?Discounts $discounts;
    public ?Shift $shift;
    public int $total_sum;
    public int $total_payment;
    public int $total_rest;
    public ?string $fiscal_code;
    public ?string $fiscal_date;
    public ?string $delivered_at;
    public ?string $created_at;
    public ?string $updated_at;
    public ?string $header;
    public ?string $footer;
    public ?string $barcode;
    public bool $is_created_offline;
    public bool $is_sent_dps;
    public ?string $sent_dps_at;

    public function __construct(
        string $id,
        ?ReceiptTypes $type,
        ?Transaction $transaction,
        int $serial,
        ?ReceiptStatus $status,
        ?Goods $goods,
        ?Payments $payments,
        ?GoodTaxes $taxes,
        ?Discounts $discounts,
        ?Shift $shift,
        int $total_sum,
        int $total_payment,
        int $total_rest,
        ?string $fiscal_code,
        ?string $fiscal_date,
        ?string $delivered_at,
        ?string $created_at,
        ?string $updated_at,
        ?string $header = null,
        ?string $footer = null,
        ?string $barcode = null,
        bool $is_created_offline = false,
        bool $is_sent_dps = false,
        ?string $sent_dps_at = null
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->transaction = $transaction;
        $this->serial = $serial;
        $this->status = $status;
        $this->goods = $goods;
        $this->payments = $payments;
        $this->taxes = $taxes;
        $this->discounts = $discounts;
        $this->shift = $shift;
        $this->total_sum = $total_sum;
        $this->total_payment = $total_payment;
        $this->total_rest = $total_rest;
        $this->fiscal_code = $fiscal_code;
        $this->fiscal_date = $fiscal_date;
        $this->delivered_at = $delivered_at;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->header = $header;
        $this->footer = $footer;
        $this->barcode = $barcode;
        $this->is_created_offline = $is_created_offline;
        $this->is_sent_dps = $is_sent_dps;
        $this->sent_dps_at = $sent_dps_at;
    }
}
