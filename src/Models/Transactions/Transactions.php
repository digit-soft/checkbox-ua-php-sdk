<?php

namespace DigitSoft\Checkbox\Models\Transactions;

use DigitSoft\Checkbox\Models\Meta;

class Transactions
{
    /** @var array<Transaction> $results */
    public $results;
    /** @var Meta|null $meta */
    public $meta;

    /**
     * Constructor
     *
     * @param array<Transaction> $transactions
     * @param Meta|null $meta
     *
     */
    public function __construct(array $transactions, ?Meta $meta)
    {
        foreach ($transactions as $transaction) {
            if (!is_a($transaction, Transaction::class)) {
                throw new \Exception('This is not a transaction class');
            }

            $this->results[] = $transaction;
        }

        $this->meta = $meta;
    }
}
