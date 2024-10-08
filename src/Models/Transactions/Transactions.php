<?php

namespace DigitSoft\Checkbox\Models\Transactions;

use DigitSoft\Checkbox\Models\Meta;
use DigitSoft\Checkbox\Models\ModelBaseWithResultsList;

class Transactions extends ModelBaseWithResultsList
{
    /**
     * Constructor
     *
     * @param  Transaction[] $transactions
     * @param  Meta|null     $meta
     * @throws \Exception
     */
    public function __construct(array $transactions, ?Meta $meta = null)
    {
        foreach ($transactions as $transaction) {
            if (! $transaction instanceof Transaction) {
                throw new \Exception('The object is not an instance of Transaction class');
            }

            $this->results[] = $transaction;
        }

        $this->meta = $meta;
    }
}
