<?php

namespace DigitSoft\Checkbox\Models\Receipts;

use DigitSoft\Checkbox\Models\ModelBase;

class Delivery extends ModelBase
{
    protected ?string $phone = null;
    /** @var string[] */
    protected array $emails;

    /**
     * Constructor
     *
     * @param  string[]    $emails
     * @param  string|null $phone
     */
    public function __construct(array $emails = [], ?string $phone = null)
    {
        $this->phone = $phone;
        $this->emails = $emails;
    }

    /**
     * @return string[]
     */
    public function emails(): array
    {
        return $this->emails;
    }

    /**
     * Getter for `phone`.
     *
     * @return string|null
     */
    public function phone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param  string $email
     */
    public function addEmail(string $email): void
    {
        $this->emails[] = $email;
    }

    /**
     * @param  string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
}
