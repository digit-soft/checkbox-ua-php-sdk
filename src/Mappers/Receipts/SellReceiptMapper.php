<?php

namespace DigitSoft\Checkbox\Mappers\Receipts;

use DigitSoft\Checkbox\Models\Receipts\SellReceipt;
use DigitSoft\Checkbox\Mappers\Receipts\Goods\GoodsMapper;
use DigitSoft\Checkbox\Mappers\Receipts\Payments\PaymentsMapper;
use DigitSoft\Checkbox\Mappers\Receipts\Discounts\DiscountsMapper;

class SellReceiptMapper
{
    /**
     * @param SellReceipt $receipt
     * @return array
     */
    public function objectToJson(SellReceipt $receipt): array
    {
        $output = [
            'cashier_name' => $receipt->cashier_name,
            'departament' => $receipt->departament,
            'goods' => (new GoodsMapper())->objectToJson($receipt->goods),
            'delivery' => (new DeliveryMapper())->objectToJson($receipt->delivery),
            'discounts' => (new DiscountsMapper())->objectToJson($receipt->discounts),
            'payments' => (new PaymentsMapper())->objectToJson($receipt->payments),
            'header' => $receipt->header,
            'footer' => $receipt->footer,
            'barcode' => $receipt->barcode
        ];

        if (isset($receipt->id)) {
            $output['id'] = $receipt->id;
        }

        if (isset($receipt->related_receipt_id)) {
            $output['related_receipt_id'] = $receipt->related_receipt_id;
        }

        return $output;
    }
}
