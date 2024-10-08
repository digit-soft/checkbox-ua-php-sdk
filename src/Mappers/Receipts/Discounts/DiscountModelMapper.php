<?php

namespace DigitSoft\Checkbox\Mappers\Receipts\Discounts;

use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;
use DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel;

class DiscountModelMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?DiscountModel
    {
        if ($json === null) {
            return null;
        }

        return new DiscountModel(
            $json['type'],
            $json['mode'],
            $json['value'],
            $json['tax_code'] ?? null,
            $json['tax_codes'] ?? [],
            $json['name'] ?? null
        );
    }

    /**
     * @param DiscountModel $discountModel
     * @return array<string, mixed>
     */
    public function objectToJson(DiscountModel $discountModel): array
    {
        return [
            'type' => $discountModel->type,
            'mode' => $discountModel->mode,
            'value' => $discountModel->value,
            'tax_code' => $discountModel->tax_code ?? '',
            'tax_codes' => $discountModel->tax_codes,
            'name' => $discountModel->name ?? ''
        ];
    }
}
