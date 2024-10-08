<?php

namespace DigitSoft\Checkbox\Mappers\Reports;

use DigitSoft\Checkbox\Mappers\MetaMapper;
use DigitSoft\Checkbox\Models\Reports\Reports;
use DigitSoft\Checkbox\Mappers\Shifts\ZReportMapper;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class ReportsMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Reports
    {
        if ($json === null) {
            return null;
        }

        $reportsArr = [];

        foreach ($json['results'] as $jsonRow) {
            $report = (new ZReportMapper)->jsonToObject($jsonRow);

            if (!is_null($report)) {
                $reportsArr[] = $report;
            }
        }

        $meta = (new MetaMapper)->jsonToObject($json['meta']);

        return new Reports($reportsArr, $meta);
    }
}
