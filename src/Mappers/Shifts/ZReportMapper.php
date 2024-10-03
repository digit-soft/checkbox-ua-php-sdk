<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Models\Shifts\ZReport;

class ZReportMapper
{
    /**
     * @param mixed $json
     * @return ZReport|null
     */
    public function jsonToObject($json): ?ZReport
    {
        if (is_null($json)) {
            return null;
        }

        $payments = (new PaymentsMapper())->jsonToObject($json['payments']);
        $taxes = (new TaxesMapper())->jsonToObject($json['taxes']);

        $report = new ZReport(
            $json['id'],
            $json['serial'],
            $json['is_z_report'],
            $payments,
            $taxes,
            $json['sell_receipts_count'],
            $json['return_receipts_count'],
            $json['transfers_count'],
            $json['transfers_sum'],
            $json['created_at'],
            $json['updated_at']
        );

        return $report;
    }
}
