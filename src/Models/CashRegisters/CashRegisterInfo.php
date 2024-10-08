<?php

namespace DigitSoft\Checkbox\Models\CashRegisters;

use DigitSoft\Checkbox\Models\ModelBase;

class CashRegisterInfo extends ModelBase
{
    public string $id;
    public string $fiscal_number;
    public string $created_at;
    public string $updated_at;
    public string $address;
    public string $title;
    public bool $offline_mode;
    public bool $stay_offline;
    public bool $has_shift;

    public ?DocumentsState $documents_state;

    public function __construct(
        string $id,
        string $fiscal_number,
        string $created_at,
        string $updated_at,
        string $address,
        string $title,
        bool $offline_mode,
        bool $stay_offline,
        bool $has_shift,
        ?DocumentsState $documents_state
    ) {
        $this->id = $id;
        $this->fiscal_number = $fiscal_number;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->address = $address;
        $this->title = $title;
        $this->offline_mode = $offline_mode;
        $this->stay_offline = $stay_offline;
        $this->has_shift = $has_shift;
        $this->documents_state = $documents_state;
    }
}
