<?php

namespace DigitSoft\Checkbox\Models\Cashier;

use DigitSoft\Checkbox\Models\ModelBase;

/**
 * @method static static make(string $id, string $title, string $edrpou, string $tax_number, string $created_at, string $updated_at, ?string $subscription_exp)
 */
class Organization extends ModelBase
{
    public string $id;
    public string $title;
    public string $edrpou;
    public string $tax_number;
    public string $created_at;
    public string $updated_at;
    public ?string $subscription_exp;

    public function __construct(
        string $id,
        string $title,
        string $edrpou,
        string $tax_number,
        string $created_at,
        string $updated_at,
        ?string $subscription_exp
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->edrpou = $edrpou;
        $this->tax_number = $tax_number;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->subscription_exp = $subscription_exp;
    }
}
