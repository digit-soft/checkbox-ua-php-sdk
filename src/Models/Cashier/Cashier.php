<?php

namespace DigitSoft\Checkbox\Models\Cashier;

use DigitSoft\Checkbox\Models\ModelBase;

/**
 * @method static static make(string $id, string $full_name, string $nin, string $key_id, string $signature_type, string $created_at, string $updated_at, ?string $certificate_end = null, ?string $blocked = null, ?Organization $organization = null)
 */
class Cashier extends ModelBase
{
    public string $id;
    public string $full_name;
    public string $nin;
    public string $key_id;
    public string $signature_type;
    public string $created_at;
    public string $updated_at;
    public ?string $certificate_end;
    public ?string $blocked;
    public ?Organization $organization;

    public function __construct(
        string $id,
        string $full_name,
        string $nin,
        string $key_id,
        string $signature_type,
        string $created_at,
        string $updated_at,
        ?string $certificate_end = null,
        ?string $blocked = null,
        ?Organization $organization = null
    ) {
        $this->id = $id;
        $this->full_name = $full_name;
        $this->nin = $nin;
        $this->key_id = $key_id;
        $this->signature_type = $signature_type;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->certificate_end = $certificate_end;
        $this->blocked = $blocked;
        $this->organization = $organization;
    }
}
