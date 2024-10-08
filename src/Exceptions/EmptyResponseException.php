<?php

namespace DigitSoft\Checkbox\Exceptions;

class EmptyResponseException extends \Exception
{
    public function __construct($message = "API returned an empty JSON response", $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
