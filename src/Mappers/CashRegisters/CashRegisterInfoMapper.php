<?php

namespace DigitSoft\Checkbox\Mappers\CashRegisters;

use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;
use DigitSoft\Checkbox\Models\CashRegisters\CashRegisterInfo;

class CashRegisterInfoMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?CashRegisterInfo
    {
        if ($json === null) {
            return null;
        }

        $documentsState = (new DocumentsStateMapper)->jsonToObject($json['documents_state']);

        return new CashRegisterInfo(
            $json['id'],
            $json['fiscal_number'],
            $json['created_at'],
            $json['updated_at'],
            $json['address'],
            $json['title'],
            $json['offline_mode'],
            $json['stay_offline'],
            $json['has_shift'],
            $documentsState
        );
    }
}
