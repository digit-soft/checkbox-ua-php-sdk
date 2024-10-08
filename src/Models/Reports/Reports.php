<?php

namespace DigitSoft\Checkbox\Models\Reports;

use DigitSoft\Checkbox\Models\Meta;
use DigitSoft\Checkbox\Models\Shifts\ZReport;
use DigitSoft\Checkbox\Models\ModelBaseWithResultsList;

class Reports extends ModelBaseWithResultsList
{
    /**
     * Constructor
     *
     * @param  array<ZReport> $reports
     * @param  Meta|null      $meta
     * @throws \Exception
     */
    public function __construct(array $reports, ?Meta $meta)
    {
        foreach ($reports as $report) {
            if (! $report instanceof ZReport) {
                throw new \Exception('This is not ZReport class');
            }

            $this->results[] = $report;
        }

        $this->meta = $meta;
    }
}
