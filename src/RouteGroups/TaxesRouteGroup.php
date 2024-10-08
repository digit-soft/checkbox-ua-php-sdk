<?php

namespace DigitSoft\Checkbox\RouteGroups;

use DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes;
use DigitSoft\Checkbox\Mappers\Receipts\Taxes\GoodTaxesMapper;

class TaxesRouteGroup extends RouteGroup
{
    /**
     * Get all taxes.
     *
     * @return \DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all(): ?GoodTaxes
    {
        $json = $this->api->sendJsonRequest(
            $this->routes->getAllTaxes(),
        );

        return (new GoodTaxesMapper)->jsonToObject($json);
    }

    /**
     * Get all taxes by the current cashier.
     *
     * @return \DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function allByCashier(): ?GoodTaxes
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getAllTaxesByCashier(),
        );

        return (new GoodTaxesMapper)->jsonToObject($json);
    }
}
