<?php

namespace DigitSoft\Checkbox\Mappers\Cashier;

use DigitSoft\Checkbox\Models\Cashier\Organization;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class OrganizationMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Organization
    {
        if (is_null($json)) {
            return null;
        }

        return Organization::make(
            $json['id'],
            $json['title'],
            $json['edrpou'],
            $json['tax_number'],
            $json['created_at'],
            $json['updated_at'],
            $json['subscription_exp'] ?? null
        );
    }
}
