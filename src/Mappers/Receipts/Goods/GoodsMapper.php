<?php

namespace DigitSoft\Checkbox\Mappers\Receipts\Goods;

use DigitSoft\Checkbox\Models\ModelBase;
use DigitSoft\Checkbox\Models\Receipts\Goods\Goods;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class GoodsMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Goods
    {
        if ($json === null) {
            return null;
        }

        $result = [];

        foreach ($json as $goodRow) {
            $good = (new GoodItemModelMapper)->jsonToObject($goodRow);

            if (!is_null($good)) {
                $result[] = $good;
            }
        }

        return new Goods($result);
    }

    /**
     * Map object to the array.
     *
     * @param  \DigitSoft\Checkbox\Models\Receipts\Goods\Goods $model
     * @return array
     */
    public function objectToJson(Goods $model): array
    {
        $result = [];

        foreach ($model->results as $goodRow) {
            $result[] = (new GoodItemModelMapper)->objectToJson($goodRow);
        }

        return $result;
    }
}
