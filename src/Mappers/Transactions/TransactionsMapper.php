<?php

namespace DigitSoft\Checkbox\Mappers\Transactions;

use DigitSoft\Checkbox\Mappers\MetaMapper;
use DigitSoft\Checkbox\Models\Transactions\Transactions;

class TransactionsMapper
{
    /**
     * @param mixed $json
     * @return Transactions|null
     */
    public function jsonToObject($json): ?Transactions
    {
        if (is_null($json)) {
            return null;
        }

        $transactionArr = [];

        foreach ($json['results'] as $jsonRow) {
            $trans = (new TransactionMapper())->jsonToObject($jsonRow);

            if (!is_null($trans)) {
                $transactionArr[] = $trans;
            }
        }

        $meta = (new MetaMapper())->jsonToObject($json['meta']);

        $transactions = new Transactions(
            $transactionArr,
            $meta
        );

        return $transactions;
    }
}
