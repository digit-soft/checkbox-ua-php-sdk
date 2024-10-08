<?php

namespace DigitSoft\Checkbox;

use DigitSoft\Checkbox\Models\Shifts\ShiftsQueryParams;
use DigitSoft\Checkbox\Models\Reports\ReportsQueryParams;
use DigitSoft\Checkbox\Models\Receipts\ReceiptsQueryParams;
use DigitSoft\Checkbox\Models\Reports\PeriodicalReportQueryParams;
use DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams;
use DigitSoft\Checkbox\Models\CashRegisters\CashRegistersQueryParams;

class Routes
{
    /** @var string Base URL of `checkbox.ua` API */
    private string $apiBaseUrl;

    public function __construct(string $apiBaseUrl)
    {
        $this->apiBaseUrl = $apiBaseUrl;
    }

    public function signInCashier(): string
    {
        return $this->apiBaseUrl . '/cashier/signin';
    }

    public function signOutCashier(): string
    {
        return $this->apiBaseUrl . '/cashier/signout';
    }

    public function signInCashierViaSignature(): string
    {
        return $this->apiBaseUrl . '/cashier/signinSignature';
    }

    public function signInCashierViaPinCode(): string
    {
        return $this->apiBaseUrl . '/cashier/signinPinCode';
    }

    public function getCashierProfile(): string
    {
        return $this->apiBaseUrl . '/cashier/me';
    }

    public function getCashierShift(): string
    {
        return $this->apiBaseUrl . '/cashier/shift';
    }

    public function createShift(): string
    {
        return $this->apiBaseUrl . '/shifts';
    }

    public function getShifts(ShiftsQueryParams $queryParams): string
    {
        $params = [];

        if (count($queryParams->statuses) > 0) {
            foreach ($queryParams->statuses as $status) {
                $params[] = "statuses={$status}";
            }
        }

        $value = ($queryParams->desc) ? 'true' : 'false';
        $params[] = "desc={$value}";

        $params[] = "limit={$queryParams->limit}";
        $params[] = "offset={$queryParams->offset}";

        $params = implode('&', $params);

        return $this->apiBaseUrl . '/shifts?' . $params;
    }

    public function closeShift(): string
    {
        return $this->apiBaseUrl . '/shifts/close';
    }

    public function getShift(string $shiftId): string
    {
        return $this->apiBaseUrl . '/shifts/' . $shiftId;
    }

    public function pingTaxServiceAction(): string
    {
        return $this->apiBaseUrl . '/cash-registers/ping-tax-service';
    }

    public function getCashRegisters(CashRegistersQueryParams $queryParams): string
    {
        $params = [];

        if (!is_null($queryParams->inUse)) {
            $value = ($queryParams->inUse) ? 'true' : 'false';

            $params[] = "in_use={$value}";
        }

        $params[] = "limit={$queryParams->limit}";
        $params[] = "offset={$queryParams->offset}";

        $params = implode('&', $params);

        return $this->apiBaseUrl . '/cash-registers?' . $params;
    }

    public function getCashRegister(string $registerId): string
    {
        return $this->apiBaseUrl . '/cash-registers/' . $registerId;
    }

    public function getCashRegisterInfo(): string
    {
        return $this->apiBaseUrl . '/cash-registers/info';
    }

    public function getReceipt(string $receiptId): string
    {
        return $this->apiBaseUrl . '/receipts/' . $receiptId;
    }

    public function createSellReceipt(): string
    {
        return $this->apiBaseUrl . '/receipts/sell';
    }

    public function createServiceReceipt(): string
    {
        return $this->apiBaseUrl . '/receipts/service';
    }

    public function getReceipts(ReceiptsQueryParams $queryParams): string
    {
        $params = [];

        if (isset($queryParams->fiscal_code)) {
            $params[] = "fiscal_code={$queryParams->fiscal_code}";
        }

        if (isset($queryParams->serial)) {
            $params[] = "serial={$queryParams->serial}";
        }

        $value = ($queryParams->desc) ? 'true' : 'false';
        $params[] = "desc={$value}";

        $params[] = "limit={$queryParams->limit}";
        $params[] = "offset={$queryParams->offset}";

        $params = implode('&', $params);

        return $this->apiBaseUrl . '/receipts?' . $params;
    }

    public function getReceiptPdf(string $receiptId): string
    {
        return $this->apiBaseUrl . '/receipts/' . $receiptId . '/pdf';
    }

    public function getReceiptHtml(string $receiptId): string
    {
        return $this->apiBaseUrl . '/receipts/' . $receiptId . '/html';
    }

    public function getReceiptText(string $receiptId): string
    {
        return $this->apiBaseUrl . '/receipts/' . $receiptId . '/text';
    }

    public function getReceiptQrCodeImage(string $receiptId): string
    {
        return $this->apiBaseUrl . '/receipts/' . $receiptId . '/qrcode';
    }

    public function getReceiptImagePng(string $receiptId, int $width = 30, int $paperWidth = 58): string
    {
        return $this->apiBaseUrl . '/receipts/' . $receiptId . '/png?width=' . $width . '&paper_width=' . $paperWidth;
    }

    public function getAllTaxes(): string
    {
        return $this->apiBaseUrl . '/tax';
    }

    public function getAllTaxesByCashier(): string
    {
        return $this->apiBaseUrl . '/cashier/tax';
    }

    public function createXReport(): string
    {
        return $this->apiBaseUrl . '/reports';
    }

    public function getReport(string $reportId): string
    {
        return $this->apiBaseUrl . '/reports/' . $reportId;
    }

    public function getReportText(string $reportId, int $printArea): string
    {
        return $this->apiBaseUrl . '/reports/' . $reportId . '/text?width=' . $printArea;
    }

    public function getPeriodicalReport(PeriodicalReportQueryParams $queryParams): string
    {
        return $this->apiBaseUrl . '/reports/periodical?from_date=' . $queryParams->from_date
            . '&to_date=' . $queryParams->to_date
            . '&width=' . $queryParams->width;
    }

    public function getReports(ReportsQueryParams $queryParams): string
    {
        $params = [];

        if (isset($queryParams->from_date)) {
            $params[] = "from_date={$queryParams->from_date}";
        }

        if (isset($queryParams->to_date)) {
            $params[] = "to_date={$queryParams->to_date}";
        }

        if (! empty($queryParams->shift_id)) {
            foreach ($queryParams->shift_id as $shiftId) {
                $params[] = "shift_id={$shiftId}";
            }
        }

        if ($queryParams->is_z_report !== null) {
            $params[] = "is_z_report=" . ($queryParams->is_z_report ? 'true' : 'false');
        }

        $value = ($queryParams->desc) ? 'true' : 'false';
        $params[] = "desc={$value}";

        $params[] = "limit={$queryParams->limit}";
        $params[] = "offset={$queryParams->offset}";

        $params = implode('&', $params);

        return $this->apiBaseUrl . '/reports?' . $params;
    }

    public function getTransactions(TransactionsQueryParams $queryParams): string
    {
        $params = [];

        foreach ($queryParams->statuses as $status) {
            $params[] = "status={$status}";
        }

        foreach ($queryParams->types as $type) {
            $params[] = "type={$type}";
        }

        $params[] = "limit={$queryParams->limit}";
        $params[] = "offset={$queryParams->offset}";

        $params = implode('&', $params);

        return $this->apiBaseUrl . '/transactions?' . $params;
    }

    public function getTransaction(string $transactionId): string
    {
        return $this->apiBaseUrl . '/transactions/' . $transactionId;
    }

    public function updateTransaction(string $transactionId): string
    {
        return $this->apiBaseUrl . '/transactions/' . $transactionId;
    }
}
