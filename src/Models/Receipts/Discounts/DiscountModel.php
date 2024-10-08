<?php

namespace DigitSoft\Checkbox\Models\Receipts\Discounts;

class DiscountModel
{
    public const string TYPE_DISCOUNT = 'DISCOUNT';
    public const string TYPE_EXTRA_CHARGE = 'EXTRA_CHARGE';

    public const string MODE_PERCENT = 'PERCENT';
    public const string MODE_VALUE = 'VALUE';

    private static array $allowedTypes = [
        self::TYPE_DISCOUNT,
        self::TYPE_EXTRA_CHARGE
    ];

    private static array $allowedModes = [
        self::MODE_PERCENT,
        self::MODE_VALUE
    ];

    public string $type;
    public string $mode;
    public int $value;
    public ?string $tax_code;
    /** @var string[] */
    public array $tax_codes;
    public ?string $name;

    /**
     * Constructor
     *
     * @param  string        $type
     * @param  string        $mode
     * @param  int           $value
     * @param  string|null   $tax_code
     * @param  array<string> $tax_codes
     * @param  string|null   $name
     * @throws \Exception
     */
    public function __construct(
        string $type,
        string $mode,
        int $value,
        ?string $tax_code = null,
        array $tax_codes = [],
        ?string $name = null
    ) {
        $this->type = $type;
        $this->mode = $mode;
        $this->value = $value;
        $this->tax_code = $tax_code;
        $this->tax_codes = $tax_codes;
        $this->name = $name;

        $this->validateTypes();
        $this->validateModes();
    }

    private function validateTypes(): void
    {
        if (! in_array($this->type, static::$allowedTypes, true)) {
            throw new \Exception("Type '{$this->type}' is not allowed");
        }
    }

    private function validateModes(): void
    {
        if (! in_array($this->mode, static::$allowedModes, true)) {
            throw new \Exception("Mode '{$this->mode}' is not allowed");
        }
    }
}
