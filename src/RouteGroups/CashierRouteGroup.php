<?php

namespace DigitSoft\Checkbox\RouteGroups;

use DigitSoft\Checkbox\Models\Shifts\Shift;
use DigitSoft\Checkbox\Models\Cashier\Cashier;
use DigitSoft\Checkbox\Mappers\Shifts\ShiftMapper;
use DigitSoft\Checkbox\Mappers\Cashier\CashierMapper;
use DigitSoft\Checkbox\Exceptions\EmptyResponseException;

class CashierRouteGroup extends RouteGroup
{
    /**
     * Sign in cashier depending on given config.
     *
     * @return void
     * @throws \DigitSoft\Checkbox\Exceptions\EmptyResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function signIn(): void
    {
        if (isset($this->config->cashierPinCode)) {
            $this->signInWithPinCode();
        } else {
            $this->signInWithPassword();
        }
    }

    /**
     * Sign out.
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function signOut(): void
    {
        if (! $this->api->hasCashierAuthToken()) {
            return;
        }
        $this->api->sendJsonRequestAuthorized(
            $this->routes->signOutCashier(),
            'POST'
        );
        $this->api->setCashierAuthToken(null);
    }

    /**
     * Get a profile of the current cashier.
     *
     * @return \DigitSoft\Checkbox\Models\Cashier\Cashier|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getProfile(): ?Cashier
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getCashierProfile(),
        );

        return (new CashierMapper)->jsonToObject($json);
    }

    /**
     * Get current opened shift of the cashier.
     *
     * @return \DigitSoft\Checkbox\Models\Shifts\Shift|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getShift(): ?Shift
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getCashierShift(),
        );

        return (new ShiftMapper)->jsonToObject($json);
    }

    /**
     * Sign in with PIN code.
     *
     * @return void
     * @throws \DigitSoft\Checkbox\Exceptions\EmptyResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function signInWithPinCode(): void
    {
        $body = [
            'pin_code' => $this->config->cashierPinCode,
        ];
        $json = $this->api->sendJsonRequest(
            $this->routes->signInCashierViaPinCode(),
            'POST',
            $body
        );

        if ($json === null) {
            throw new EmptyResponseException();
        }

        $this->api->setCashierAuthToken($json['access_token']);
    }

    /**
     * Sign in with login + pass.
     *
     * @return void
     * @throws \DigitSoft\Checkbox\Exceptions\EmptyResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function signInWithPassword(): void
    {
        $body = [
            'login' => $this->config->cashierLogin,
            'password' => $this->config->cashierPass,
        ];
        $json = $this->api->sendJsonRequest(
            $this->routes->signInCashier(),
            'POST',
            $body
        );

        if (is_null($json)) {
            throw new EmptyResponseException();
        }

        $this->api->setCashierAuthToken($json['access_token']);
    }
}
