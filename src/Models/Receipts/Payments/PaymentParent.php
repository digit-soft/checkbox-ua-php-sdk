<?php

namespace DigitSoft\Checkbox\Models\Receipts\Payments;

use DigitSoft\Checkbox\Models\ModelBase;

class PaymentParent extends ModelBase
{
    public const string TYPE_CASH = 'CASH';
    public const string TYPE_CARD = 'CASHLESS';

    public string $type;
    public string $value;
    public ?string $label = null;

    public function __construct(
        string $type,
        string $value,
        ?string $label = null
    ) {
        if (! in_array($type, [static::TYPE_CASH, static::TYPE_CARD], true)) {
            throw new \Exception('Wrong payment type');
        }

        $this->type = $type;
        $this->value = $value;

        if (is_string($label) && mb_strlen($label) > 128) {
            throw new \Exception('Label is too long');
        }

        $this->label = $label;
    }
}
