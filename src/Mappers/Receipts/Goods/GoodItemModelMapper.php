<?php

namespace DigitSoft\Checkbox\Mappers\Receipts\Goods;

use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;
use DigitSoft\Checkbox\Mappers\Receipts\Discounts\DiscountsMapper;
use DigitSoft\Checkbox\Mappers\Receipts\Taxes\GoodTaxesMapper;
use DigitSoft\Checkbox\Models\Receipts\Goods\GoodItemModel;

class GoodItemModelMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?GoodItemModel
    {
        if ($json === null) {
            return null;
        }

        $goodModel = (new GoodModelMapper)->jsonToObject($json['good']);
        $taxes = (new GoodTaxesMapper)->jsonToObject($json['taxes']);
        $discounts = (new DiscountsMapper)->jsonToObject($json['discounts']);

        return new GoodItemModel(
            $goodModel,
            $json['quantity'],
            $discounts,
            $taxes,
            $json['is_return'],
            $json['sum'],
            $json['good_id'] ?? null
        );
    }

    /**
     * @param GoodItemModel $itemModel
     * @return array<string, mixed>
     */
    public function objectToJson(GoodItemModel $itemModel): array
    {
        if (! isset($itemModel->good)) {
            return [];
        }

        return [
            'good' => (new GoodModelMapper)->objectToJson($itemModel->good),
            'quantity' => $itemModel->quantity,
            'is_return' => $itemModel->is_return,
            'discounts' => (new DiscountsMapper)->objectToJson($itemModel->discounts)
        ];
    }
}
