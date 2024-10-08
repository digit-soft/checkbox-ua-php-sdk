<?php

namespace DigitSoft\Checkbox\Mappers\Transactions;

use DigitSoft\Checkbox\Models\Transactions\Transaction;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class TransactionMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Transaction
    {
        if ($json === null) {
            return null;
        }

        return new Transaction(
            $json['id'],
            $json['type'],
            $json['serial'],
            $json['status'],
            $json['request_signed_at'],
            $json['request_received_at'],
            $json['response_status'],
            $json['response_error_message'],
            $json['created_at'],
            $json['updated_at'],
            $json['request_data'] ?? '',
            $json['request_signature'] ?? '',
            $json['response_id'] ?? null,
            $json['response_data_signature'] ?? null,
            $json['response_data'] ?? null
        );
    }
}
