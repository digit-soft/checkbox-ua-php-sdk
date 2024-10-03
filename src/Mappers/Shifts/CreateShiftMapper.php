<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Exceptions\AlreadyOpenedShiftException;
use DigitSoft\Checkbox\Mappers\Cashier\CashierMapper;
use DigitSoft\Checkbox\Mappers\CashRegisters\CashRegisterMapper;
use DigitSoft\Checkbox\Models\Shifts\CreateShift;

class CreateShiftMapper
{
    /**
     * @param mixed $json
     * @return CreateShift|null
     */
    public function jsonToObject($json): ?CreateShift
    {
        if (is_null($json)) {
            return null;
        }

        if (!empty($json['message']) and $json['message'] == 'Касир вже працює з даною касою') {
            throw new AlreadyOpenedShiftException($json['message']);
        }

        $zReport = (new ZReportMapper())->jsonToObject($json['z_report']);
        $initialTransaction = (new InitialTransactionMapper())->jsonToObject($json['initial_transaction']);
        $closingTransaction = (new ClosingTransactionMapper())->jsonToObject($json['closing_transaction']);
        $balance = (new BalanceMapper())->jsonToObject($json['balance']);
        $taxes = (new TaxesMapper())->jsonToObject($json['taxes']);
        $cashRegister = (new CashRegisterMapper())->jsonToObject($json['cash_register']);
        $cashier = (new CashierMapper())->jsonToObject($json['cashier']);

        $shift = new CreateShift(
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
