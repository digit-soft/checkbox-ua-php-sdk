<?php

namespace DigitSoft\Checkbox\Models\CashRegisters;

use DigitSoft\Checkbox\Models\ModelBase;

class DocumentsState extends ModelBase
{
    public int $last_receipt_code;
    public int $last_report_code;
    public int $last_z_report_code;

    public function __construct(
        int $last_receipt_code,
        int $last_report_code,
        int $last_z_report_code
    ) {
        $this->last_receipt_code = $last_receipt_code;
        $this->last_report_code = $last_report_code;
        $this->last_z_report_code = $last_z_report_code;
    }
}
