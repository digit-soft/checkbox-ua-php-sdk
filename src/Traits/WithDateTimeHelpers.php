<?php

namespace DigitSoft\Checkbox\Traits;

use Carbon\Carbon;

trait WithDateTimeHelpers
{
    /**
     * Cast date-time object to the string.
     *
     * @param  mixed $dateTime
     * @return string|null
     */
    protected static function castDateTimeToString(mixed $dateTime): ?string
    {
        if ($dateTime === null) {
            return null;
        }
        if (is_string($dateTime)) {
            try {
                return (new \DateTime($dateTime))
                    ->setTimezone(new \DateTimeZone('UTC'))
                    ->format(\DateTimeInterface::ATOM);
            } catch (\DateMalformedStringException $e) {
                return null;
            }

        }
        if (is_object($dateTime)) {
            return match (true) {
                $dateTime instanceof Carbon => $dateTime->avoidMutation()->utc()->toAtomString(),
                $dateTime instanceof \DateTime => $dateTime->setTimezone(new \DateTimeZone('UTC'))
                    ->format(\DateTimeInterface::ATOM),
                default => null,
            };
        }

        return null;
    }
}
