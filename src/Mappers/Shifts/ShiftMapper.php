<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Models\Shifts\Shift;
use DigitSoft\Checkbox\Mappers\Cashier\CashierMapper;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;
use DigitSoft\Checkbox\Mappers\CashRegisters\CashRegisterMapper;

class ShiftMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Shift
    {
        if ($json === null) {
            return null;
        }

        $zReport = (new ZReportMapper)->jsonToObject($json['z_report'] ?? null);
        $balance = (new BalanceMapper)->jsonToObject($json['balance'] ?? null);
        $initialTransaction = (new InitialTransactionMapper)->jsonToObject($json['initial_transaction'] ?? null);
        $closingTransaction = isset($json['closing_transaction'])
            ? (new ClosingTransactionMapper)->jsonToObject($json['closing_transaction'])
            : null;

        $cashRegister = (new CashRegisterMapper)->jsonToObject($json['cash_register'] ?? null);
        $taxes = (new TaxesMapper)->jsonToObject($json['taxes'] ?? null);
        $cashier = (new CashierMapper)->jsonToObject($json['cashier'] ?? null);

        return Shift::make(
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
    }
}
