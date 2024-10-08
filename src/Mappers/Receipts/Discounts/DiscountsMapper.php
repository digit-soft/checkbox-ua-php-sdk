<?php

namespace DigitSoft\Checkbox\Mappers\Receipts\Discounts;

use DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class DiscountsMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Discounts
    {
        if ($json === null) {
            return null;
        }

        $results = [];

        foreach ($json as $row) {
            $discount = (new DiscountModelMapper)->jsonToObject($row);

            if (!is_null($discount)) {
                $results[] = $discount;
            }
        }

        return new Discounts($results);
    }

    /**
     * @param Discounts|null $discounts
     * @return array<array<string, string>>
     */
    public function objectToJson(?Discounts $discounts = null): array
    {
        if (is_null($discounts)) {
            return [];
        }

        $results = [];

        foreach ($discounts->results as $discount) {
            $results[] = (new DiscountModelMapper)->objectToJson($discount);
        }

        return $results;
    }
}
