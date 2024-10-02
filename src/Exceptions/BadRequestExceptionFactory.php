<?php

namespace DigitSoft\Checkbox\Exceptions;

class BadRequestExceptionFactory
{
    /**
     * @param string $message
     * @return \Exception
     */
    public static function getExceptionByMessage($message)
    {
        if (
            $message === 'Каса зайнята іншим касиром'
            or $message === 'Касир вже працює з даною касою'
        ) {
            return new AlreadyOpenedShiftException($message);
        }

        if ($message === 'Зміну не відкрито') {
            return new NoActiveShiftException($message);
        }

        return new BadRequestException($message);
    }
}
