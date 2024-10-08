<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Models\Shifts\ZReport;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class ZReportMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?ZReport
    {
        if ($json === null) {
            return null;
        }

        $payments = (new PaymentsMapper)->jsonToObject($json['payments']);
        $taxes = (new TaxesMapper)->jsonToObject($json['taxes']);

        return new ZReport(
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
    }
}
