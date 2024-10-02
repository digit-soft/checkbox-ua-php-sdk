<?php

namespace DigitSoft\Checkbox\Mappers\Receipts;

use DigitSoft\Checkbox\Mappers\Receipts\Discounts\DiscountsMapper;
use DigitSoft\Checkbox\Mappers\Receipts\Goods\GoodsMapper;
use DigitSoft\Checkbox\Mappers\Receipts\Payments\PaymentsMapper;
use DigitSoft\Checkbox\Mappers\Receipts\Taxes\GoodTaxesMapper;
use DigitSoft\Checkbox\Mappers\Shifts\ShiftMapper;
use DigitSoft\Checkbox\Mappers\Transactions\TransactionMapper;
use DigitSoft\Checkbox\Models\Receipts\Receipt;

class ReceiptMapper
{
    /**
     * @param mixed $json
     * @return Receipt|null
     */
    public function jsonToObject($json): ?Receipt
    {
        if (is_null($json)) {
            return null;
        }

        $transaction = (new TransactionMapper())->jsonToObject($json['transaction']);
        $receiptType = (new ReceiptTypeMapper())->jsonToObject($json['type']);
        $receiptStatus = (new ReceiptStatusMapper())->jsonToObject($json['status']);
        $goods = (new GoodsMapper())->jsonToObject($json['goods']);

        $payments = (new PaymentsMapper())->jsonToObject($json['payments']);
        $taxes = (new GoodTaxesMapper())->jsonToObject($json['taxes']);
        $discounts = (new DiscountsMapper())->jsonToObject($json['discounts']);
        $shift = (new ShiftMapper())->jsonToObject($json['shift']);

        $receipt = new Receipt(
            $json['id'],
            $receiptType,
            $transaction,
            $json['serial'],
            $receiptStatus,
            $goods,
            $payments,
            $json['total_sum'] ?? $json['sum'],
            $json['total_payment'],
            $json['total_rest'] ?? $json['rest'],
            $json['fiscal_code'],
            $json['fiscal_date'],
            $json['delivered_at'] ?? '',
            $json['created_at'],
            $json['updated_at'],
            $taxes,
            $discounts ?? null,
            $json['header'] ?? '',
            $json['footer'] ?? '',
            $json['barcode'] ?? '',
            $json['is_created_offline'],
            $json['is_sent_dps'],
            $json['sent_dps_at'] ?? '',
            $shift
        );

        return $receipt;
    }
}
