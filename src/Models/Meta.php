<?php

namespace DigitSoft\Checkbox\Models;

/**
 * @method static static make(int $limit, int $offset = 0)
 */
class Meta extends ModelBase
{
    public int $limit;
    public int $offset;

    public function __construct(int $limit, int $offset = 0) {
        $this->limit = $limit;
        $this->offset = $offset;
    }
}
