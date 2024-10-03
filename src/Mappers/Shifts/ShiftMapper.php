<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Mappers\Cashier\CashierMapper;
use DigitSoft\Checkbox\Mappers\CashRegisters\CashRegisterMapper;
use DigitSoft\Checkbox\Models\Shifts\Shift;

class ShiftMapper
{
    /**
     * @param mixed $json
     * @return Shift|null
     */
    public function jsonToObject($json): ?Shift
    {
        if (is_null($json)) {
            return null;
        }

        $zReport = (new ZReportMapper())->jsonToObject($json['z_report']);
        $balance = (new BalanceMapper())->jsonToObject($json['balance']);
        $initialTransaction = (new InitialTransactionMapper())->jsonToObject($json['initial_transaction']);

        $closingTransaction = null;

        if (!is_null($json['closing_transaction'])) {
            $closingTransaction = (new ClosingTransactionMapper())->jsonToObject($json['closing_transaction']);
        }

        $cashRegister = (new CashRegisterMapper())->jsonToObject($json['cash_register'] ?? null);
        $taxes = (new TaxesMapper())->jsonToObject($json['taxes']);
        $cashier = (new CashierMapper())->jsonToObject($json['cashier'] ?? null);

        $shift = new Shift(
            $json['id'],
            $json['serial'],
            $json['status'],
            $zReport,
            $json['opened_at'],
            $json['closed_at'],
            $initialTransaction,
            $closingTransaction,
            $json['created_at'],
            $json['updated_at'],
            $balance,
            $taxes,
            $cashRegister,
            $cashier
        );

        return $shift;
    }
}
