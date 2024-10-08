<?php

namespace DigitSoft\Checkbox\Models\Receipts;

class ReceiptTypes
{
    public const string SELL = 'SELL';
    public const string RETURN = 'RETURN';
    public const string SERVICE_IN = 'SERVICE_IN';
    public const string SERVICE_OUT = 'SERVICE_OUT';

    /** @var string $value */
    protected string $value = '';

    protected static array $allowedValues = [
        self::SELL,
        self::RETURN,
        self::SERVICE_IN,
        self::SERVICE_OUT
    ];

    public function __construct(string $value)
    {
        $this->value = $value;

        $this->validate();
    }

    private function validate(): void
    {
        if (! in_array($this->value, static::$allowedValues, true)) {
            throw new \Exception("Type '{$this->value}' is not allowed");
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
