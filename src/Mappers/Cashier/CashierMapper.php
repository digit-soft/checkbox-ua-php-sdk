<?php

namespace DigitSoft\Checkbox\Mappers\Cashier;

use DigitSoft\Checkbox\Models\Cashier\Cashier;

class CashierMapper
{
    /**
     * @param mixed $json
     * @return Cashier|null
     */
    public function jsonToObject($json): ?Cashier
    {
        if (is_null($json)) {
            return null;
        }

        $organization = (new OrganizationMapper())->jsonToObject($json['organization'] ?? null);

        $cashier = new Cashier(
            $json['id'],
            $json['full_name'],
            $json['nin'],
            $json['key_id'],
            $json['signature_type'],
            $json['created_at'],
            $json['updated_at'],
            $json['certificate_end'] ?? '',
            $json['blocked'] ?? '',
            $organization
        );

        return $cashier;
    }
}
