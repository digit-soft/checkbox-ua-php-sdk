<?php

namespace DigitSoft\Checkbox\RouteGroups;

use Carbon\Carbon;
use DigitSoft\Checkbox\Models\Shifts\Shift;
use DigitSoft\Checkbox\Models\Shifts\Shifts;
use DigitSoft\Checkbox\Models\Shifts\CloseShift;
use DigitSoft\Checkbox\Models\Shifts\CreateShift;
use DigitSoft\Checkbox\Mappers\Shifts\ShiftMapper;
use DigitSoft\Checkbox\Mappers\Shifts\ShiftsMapper;
use DigitSoft\Checkbox\Models\Shifts\ShiftsQueryParams;
use DigitSoft\Checkbox\Mappers\Shifts\CloseShiftMapper;
use DigitSoft\Checkbox\Mappers\Shifts\CreateShiftMapper;

class ShiftsRouteGroup extends RouteGroup
{
    /**
     * Get a list of shifts filtered by query parameters.
     *
     * @param  \DigitSoft\Checkbox\Models\Shifts\ShiftsQueryParams|null $queryParams
     * @return \DigitSoft\Checkbox\Models\Shifts\Shifts|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all(?ShiftsQueryParams $queryParams = null): ?Shifts
    {
        $queryParams = $queryParams ?? new ShiftsQueryParams();

        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getShifts($queryParams),
        );

        return (new ShiftsMapper)->jsonToObject($json);
    }

    /**
     * Create a new shift.
     *
     * @param  string|\Carbon\Carbon|null $autoCloseAt Date and time for shift autoclose
     * @return \DigitSoft\Checkbox\Models\Shifts\CreateShift|null
     * @throws \DigitSoft\Checkbox\Exceptions\AlreadyOpenedShiftException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(string|Carbon|null $autoCloseAt = null): ?CreateShift
    {
        $body = null;
        if ($autoCloseAt !== null) {
            $autoCloseAt = $autoCloseAt instanceof Carbon ? $autoCloseAt->avoidMutation()->utc()->toAtomString() : $autoCloseAt;
            $body = ['auto_close_at' => $autoCloseAt];
        }
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->createShift(),
            'POST',
            $body
        );

        return (new CreateShiftMapper)->jsonToObject($json);
    }

    /**
     * Get one shift by ID.
     *
     * @param  string $id Shift ID
     * @return \DigitSoft\Checkbox\Models\Shifts\Shift|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function one(string $id): ?Shift
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getShift($id),
        );

        return (new ShiftMapper)->jsonToObject($json);
    }

    /**
     * Close current opened shift.
     *
     * @return \DigitSoft\Checkbox\Models\Shifts\CloseShift|null
     * @throws \DigitSoft\Checkbox\Exceptions\NoActiveShiftException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function close(): ?CloseShift
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->closeShift(),
            'POST',
        );

        return (new CloseShiftMapper)->jsonToObject($json);
    }
}
