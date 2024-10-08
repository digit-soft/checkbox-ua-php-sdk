<?php

namespace DigitSoft\Checkbox\Models\Shifts;

use DigitSoft\Checkbox\Models\ModelBase;
use DigitSoft\Checkbox\Models\Cashier\Cashier;
use DigitSoft\Checkbox\Models\CashRegisters\CashRegister;

/**
 * @method static static make(string $id, string $serial, string $status, ?ZReport $z_report, ?string $opened_at, ?string $closed_at, ?InitialTransaction $initial_transaction, ?ClosingTransaction $closing_transaction, ?string $created_at, ?string $updated_at, ?Balance $balance = null, ?Taxes $taxes = null, ?CashRegister $cash_register = null, ?Cashier $cashier = null)
 */
class Shift extends ModelBase
{
    public string $id;
    public int $serial;
    public string $status;
    public ?ZReport $z_report;
    public ?string $opened_at;
    public ?string $closed_at;
    public ?InitialTransaction $initial_transaction;
    public ?ClosingTransaction $closing_transaction;
    public string $created_at;
    public ?string $updated_at;
    public ?Balance $balance;
    public ?Taxes $taxes;
    public ?CashRegister $cash_register;
    public ?Cashier $cashier;

    public function __construct(
        string $id,
        int $serial,
        string $status,
        ?ZReport $z_report,
        ?string $opened_at,
        ?string $closed_at,
        ?InitialTransaction $initial_transaction,
        ?ClosingTransaction $closing_transaction,
        string $created_at,
        ?string $updated_at,
        ?Balance $balance = null,
        ?Taxes $taxes = null,
        ?CashRegister $cash_register = null,
        ?Cashier $cashier = null
    ) {
        $this->id = $id;
        $this->serial = $serial;
        $this->status = $status;
        $this->z_report = $z_report;
        $this->opened_at = $opened_at;
        $this->closed_at = $closed_at;
        $this->initial_transaction = $initial_transaction;
        $this->closing_transaction = $closing_transaction;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->balance = $balance;
        $this->taxes = $taxes;
        $this->cash_register = $cash_register;
        $this->cashier = $cashier;
    }
}
