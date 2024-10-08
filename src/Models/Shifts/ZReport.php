<?php

namespace DigitSoft\Checkbox\Models\Shifts;

use DigitSoft\Checkbox\Models\ModelBase;

class ZReport extends ModelBase
{
    public string $id;
    public string $serial;
    public bool $is_z_report;
    public ?Payments $payments;
    public ?Taxes $taxes;
    public int $sell_receipts_count = 0;
    public int $return_receipts_count = 0;
    public int $transfers_count;
    public int $transfers_sum;
    public string $created_at;
    public ?string $updated_at;

    public function __construct(
        string $id,
        string $serial,
        bool $is_z_report,
        ?Payments $payments,
        ?Taxes $taxes,
        int $sell_receipts_count,
        int $return_receipts_count,
        int $transfers_count,
        int $transfers_sum,
        string $created_at,
        ?string $updated_at
    ) {
        $this->id = $id;
        $this->serial = $serial;
        $this->is_z_report = $is_z_report;
        $this->payments = $payments;
        $this->taxes = $taxes;
        $this->sell_receipts_count = $sell_receipts_count;
        $this->return_receipts_count = $return_receipts_count;
        $this->transfers_count = $transfers_count;
        $this->transfers_sum = $transfers_sum;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
