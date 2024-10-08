<?php

namespace DigitSoft\Checkbox\Models\Shifts;

use DigitSoft\Checkbox\Models\ModelBase;

class Payment extends ModelBase
{
    public string $id;
    public string $type;
    public string $label;
    public int $sell_sum;
    public int $return_sum;
    public string $service_in;
    public string $service_out;

    public function __construct(
        string $id,
        string $type,
        string $label,
        int $sell_sum,
        int $return_sum,
        string $service_in,
        string $service_out
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->label = $label;
        $this->sell_sum = $sell_sum;
        $this->return_sum = $return_sum;
        $this->service_in = $service_in;
        $this->service_out = $service_out;
    }
}
