<?php

namespace DigitSoft\Checkbox\Mappers\Receipts;

use DigitSoft\Checkbox\Mappers\MetaMapper;
use DigitSoft\Checkbox\Models\Receipts\Receipts;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class ReceiptsMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Receipts
    {
        if ($json === null) {
            return null;
        }

        $receiptsArr = [];

        foreach ($json['results'] as $jsonRow) {
            $receipt = (new ReceiptMapper())->jsonToObject($jsonRow);

            if (!is_null($receipt)) {
                $receiptsArr[] = $receipt;
            }
        }

        $meta = (new MetaMapper())->jsonToObject($json['meta']);

        return new Receipts(
            $receiptsArr,
            $meta
        );
    }
}
