<?php

namespace DigitSoft\Checkbox\RouteGroups;

use DigitSoft\Checkbox\Models\CashRegisters\CashRegister;
use DigitSoft\Checkbox\Models\CashRegisters\CashRegisters;
use DigitSoft\Checkbox\Models\CashRegisters\CashRegisterInfo;
use DigitSoft\Checkbox\Mappers\CashRegisters\CashRegisterMapper;
use DigitSoft\Checkbox\Mappers\CashRegisters\CashRegistersMapper;
use DigitSoft\Checkbox\Mappers\CashRegisters\CashRegisterInfoMapper;
use DigitSoft\Checkbox\Models\CashRegisters\CashRegistersQueryParams;

class CashRegistersRouteGroup extends RouteGroup
{
    /**
     * Get cash registers (пРРО) by filters.
     *
     * @param  \DigitSoft\Checkbox\Models\CashRegisters\CashRegistersQueryParams|null $queryParams
     * @return \DigitSoft\Checkbox\Models\CashRegisters\CashRegisters|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all(?CashRegistersQueryParams $queryParams = null): ?CashRegisters
    {
        $queryParams = $queryParams ?? new CashRegistersQueryParams();

        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getCashRegisters($queryParams),
        );

        return (new CashRegistersMapper)->jsonToObject($json);
    }

    /**
     * Get one cash register by its ID.
     *
     * @param  string $id Cash register ID
     * @return \DigitSoft\Checkbox\Models\CashRegisters\CashRegister|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function one(string $id): ?CashRegister
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getCashRegister($id),
        );

        return (new CashRegisterMapper)->jsonToObject($json);
    }

    /**
     * Get info about current cash register.
     *
     * @return \DigitSoft\Checkbox\Models\CashRegisters\CashRegisterInfo|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function info(): ?CashRegisterInfo
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getCashRegisterInfo(),
        );

        return (new CashRegisterInfoMapper)->jsonToObject($json);
    }

    /**
     * Ping TAX service.
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pingTaxService(): void
    {
        $this->api->sendJsonRequestAuthorized(
            $this->routes->pingTaxServiceAction(),
        );
    }
}
