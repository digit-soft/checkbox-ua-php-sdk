<?php

namespace DigitSoft\Checkbox\Mappers\Transactions;

use DigitSoft\Checkbox\Mappers\MetaMapper;
use DigitSoft\Checkbox\Models\Transactions\Transactions;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class TransactionsMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Transactions
    {
        if ($json === null) {
            return null;
        }

        $transactionArr = [];
        foreach ($json['results'] as $jsonRow) {
            $trans = (new TransactionMapper)->jsonToObject($jsonRow);

            if ($trans !== null) {
                $transactionArr[] = $trans;
            }
        }

        $meta = (new MetaMapper)->jsonToObject($json['meta']);

        return new Transactions($transactionArr, $meta);
    }
}
