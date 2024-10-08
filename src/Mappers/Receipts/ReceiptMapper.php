<?php

namespace DigitSoft\Checkbox\Mappers\Receipts;

use DigitSoft\Checkbox\Models\Receipts\Receipt;
use DigitSoft\Checkbox\Mappers\Shifts\ShiftMapper;
use DigitSoft\Checkbox\Mappers\Receipts\Goods\GoodsMapper;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;
use DigitSoft\Checkbox\Mappers\Receipts\Taxes\GoodTaxesMapper;
use DigitSoft\Checkbox\Mappers\Transactions\TransactionMapper;
use DigitSoft\Checkbox\Mappers\Receipts\Payments\PaymentsMapper;
use DigitSoft\Checkbox\Mappers\Receipts\Discounts\DiscountsMapper;

class ReceiptMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Receipt
    {
        if ($json === null) {
            return null;
        }

        $transaction = (new TransactionMapper)->jsonToObject($json['transaction']);
        $receiptType = (new ReceiptTypeMapper)->jsonToObject($json['type']);
        $receiptStatus = (new ReceiptStatusMapper)->jsonToObject($json['status']);
        $goods = (new GoodsMapper())->jsonToObject($json['goods']);

        $payments = (new PaymentsMapper)->jsonToObject($json['payments']);
        $taxes = (new GoodTaxesMapper)->jsonToObject($json['taxes']);
        $discounts = (new DiscountsMapper)->jsonToObject($json['discounts']);
        $shift = (new ShiftMapper)->jsonToObject($json['shift']);

        return new Receipt(
            $json['id'],
            $receiptType,
            $transaction,
            $json['serial'],
            $receiptStatus,
            $goods,
            $payments,
            $taxes,
            $discounts,
            $shift,
            $json['total_sum'] ?? $json['sum'],
            $json['total_payment'],
            $json['total_rest'] ?? $json['rest'],
            $json['fiscal_code'],
            $json['fiscal_date'],
            $json['delivered_at'] ?? null,
            $json['created_at'] ?? null,
            $json['updated_at'] ?? null,
            $json['header'] ?? null,
            $json['footer'] ?? null,
            $json['barcode'] ?? '',
            $json['is_created_offline'],
            $json['is_sent_dps'],
            $json['sent_dps_at'] ?? null
        );
    }
}
