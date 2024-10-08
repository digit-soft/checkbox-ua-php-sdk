<?php

namespace DigitSoft\Checkbox\Mappers\Cashier;

use DigitSoft\Checkbox\Models\Cashier\Cashier;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class CashierMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Cashier
    {
        if ($json === null) {
            return null;
        }

        $organization = isset($json['organization'])
            ? (new OrganizationMapper)->jsonToObject($json['organization'])
            : null;

        return Cashier::make(
            $json['id'],
            $json['full_name'],
            $json['nin'],
            $json['key_id'],
            $json['signature_type'],
            $json['created_at'],
            $json['updated_at'],
            $json['certificate_end'] ?? null,
            $json['blocked'] ?? null,
            $organization
        );
    }
}
