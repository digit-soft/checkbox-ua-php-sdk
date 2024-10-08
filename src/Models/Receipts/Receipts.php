<?php

namespace DigitSoft\Checkbox\Models\Receipts;

use DigitSoft\Checkbox\Models\Meta;
use DigitSoft\Checkbox\Models\ModelBaseWithResultsList;

/**
 * @property \DigitSoft\Checkbox\Models\Shifts\Shift[]|array $results
 * @method static static make(array $receipts, ?Meta $meta = null)
 */
class Receipts extends ModelBaseWithResultsList
{
    /**
     * Constructor
     *
     * @param  Receipt[] $receipts
     * @param  Meta|null $meta
     * @throws \Exception
     */
    public function __construct(array $receipts, ?Meta $meta = null)
    {
        foreach ($receipts as $receipt) {
            if (! is_object($receipt) || ! $receipt instanceof Receipt) {
                throw new \Exception('This is not a Receipt class');
            }

            $this->results[] = $receipt;
        }

        $this->meta = $meta;
    }
}
