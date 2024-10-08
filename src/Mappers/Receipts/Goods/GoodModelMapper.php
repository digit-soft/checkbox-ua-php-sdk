<?php

namespace DigitSoft\Checkbox\Mappers\Receipts\Goods;

use DigitSoft\Checkbox\Models\Receipts\Goods\GoodModel;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class GoodModelMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?GoodModel
    {
        if ($json === null) {
            return null;
        }

        return new GoodModel(
            $json['code'],
            $json['price'],
            $json['name'],
            $json['barcode'] ?? null,
            $json['header'] ?? null,
            $json['footer'] ?? null,
            $json['uktzed'] ?? null
        );
    }

    /**
     * @param GoodModel $goodModel
     * @return array<string, mixed>
     */
    public function objectToJson(GoodModel $goodModel): array
    {
        $goodTaxeRatesArr = [];

        if (!is_null($goodModel->taxes)) {
            foreach ($goodModel->taxes->results as $tax) {
                $goodTaxeRatesArr[] = $tax->code;
            }
        }

        return [
            'code' => $goodModel->code,
            'name' => $goodModel->name,
            'barcode' => $goodModel->barcode ?? '',
            'header' => $goodModel->header ?? '',
            'footer' => $goodModel->footer ?? '',
            'price' => $goodModel->price,
            'tax' => $goodTaxeRatesArr,
            'uktzed' => $goodModel->uktzed,
        ];
    }
}
