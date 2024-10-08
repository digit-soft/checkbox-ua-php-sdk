<?php

namespace DigitSoft\Checkbox\Mappers\Shifts;

use DigitSoft\Checkbox\Models\Shifts\InitialTransaction;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class InitialTransactionMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?InitialTransaction
    {
        if ($json === null) {
            return null;
        }

        return InitialTransaction::make(
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
