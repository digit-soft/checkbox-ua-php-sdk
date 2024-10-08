<?php

namespace DigitSoft\Checkbox\Mappers\Contracts;

interface JsonToObjectMapper
{
    /**
     * Make and object from the JSON response.
     *
     * @param  array|null $json
     * @return \stdClass|null
     */
    public function jsonToObject(?array $json): mixed;
}
