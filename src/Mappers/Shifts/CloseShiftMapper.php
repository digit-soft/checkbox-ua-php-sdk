<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Exceptions\NoActiveShiftException;
use DigitSoft\Checkbox\Mappers\Cashier\CashierMapper;
use DigitSoft\Checkbox\Mappers\CashRegisters\CashRegisterMapper;
use DigitSoft\Checkbox\Models\Shifts\CloseShift;

class CloseShiftMapper
{
    /**
     * @param mixed $json
     * @return CloseShift|null
     */
    public function jsonToObject($json): ?CloseShift
    {
        if (is_null($json)) {
            return null;
        }

        if (!empty($json['message']) and $json['message'] == 'Cashier has no active shift') {
            throw new NoActiveShiftException($json['message']);
        }

        $zReport = (new ZReportMapper())->jsonToObject($json['z_report']);
        $initialTransaction = (new InitialTransactionMapper())->jsonToObject($json['initial_transaction']);
        $closingTransaction = (new ClosingTransactionMapper())->jsonToObject($json['closing_transaction']);
        $balance = (new BalanceMapper())->jsonToObject($json['balance']);
        $taxes = (new TaxesMapper())->jsonToObject($json['taxes']);
        $cashRegister = (new CashRegisterMapper())->jsonToObject($json['cash_register']);
        $cashier = (new CashierMapper())->jsonToObject($json['cashier']);

        $shift = new CloseShift(
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
