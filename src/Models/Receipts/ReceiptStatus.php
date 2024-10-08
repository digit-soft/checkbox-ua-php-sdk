<?php

namespace DigitSoft\Checkbox\Models\Receipts;

class ReceiptStatus
{
    public const string CREATED = 'CREATED';
    public const string DONE = 'DONE';
    public const string ERROR = 'ERROR';

    protected string $value = '';

    protected static array $allowedValues = [
        self::CREATED,
        self::DONE,
        self::ERROR
    ];

    public function __construct(string $value)
    {
        $this->value = $value;

        $this->validate();
    }

    /**
     * Validate a value.
     *
     * @return void
     * @throws \Exception
     */
    protected function validate(): void
    {
        if (! in_array($this->value, static::$allowedValues, true)) {
            throw new \Exception("Status '{$this->value}' is not allowed");
        }
    }

    /**
     * Getter for the $value.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
