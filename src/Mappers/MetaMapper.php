<?php

namespace DigitSoft\Checkbox\Mappers;

use DigitSoft\Checkbox\Models\Meta;
use DigitSoft\Checkbox\Mappers\Contracts\JsonToObjectMapper;

class MetaMapper implements JsonToObjectMapper
{
    /**
     * {@inheritdoc}
     */
    public function jsonToObject(?array $json): ?Meta
    {
        if ($json === null) {
            return null;
        }

        return Meta::make($json['limit'], $json['offset']);
    }
}
