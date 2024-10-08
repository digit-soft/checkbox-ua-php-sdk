<?php

namespace DigitSoft\Checkbox\Models\Reports;

use DigitSoft\Checkbox\Traits\WithDateTimeHelpers;

class PeriodicalReportQueryParams
{
    use WithDateTimeHelpers;

    public string $from_date;
    public string $to_date;
    public int $width = 42;

    public function __construct(
        mixed $from_date,
        mixed $to_date,
        int $width = 42
    ) {
        if ($width < 10 or $width > 250) {
            throw new \Exception('The print area is invalid');
        }
        if (($from_date_str = static::castDateTimeToString($from_date)) === null) {
            throw new \Exception('Start date is required.');
        }
        if (($to_date_str = static::castDateTimeToString($to_date)) === null) {
            throw new \Exception('End date is required.');
        }

        $this->from_date = $from_date_str;
        $this->to_date = $to_date_str;
        $this->width = $width;
    }
}
