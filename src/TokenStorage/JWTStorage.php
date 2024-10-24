<?php

namespace DigitSoft\Checkbox\TokenStorage;

interface JWTStorage
{
    /**
     * Get stored JWT by PIN-code.
     *
     * @param  string $licenseKey
     * @param  string $pinCode
     * @return string|null
     */
    public function getTokenByPin(string $licenseKey, string $pinCode): ?string;

    /**
     * Get stored JWT by login & password.
     *
     * @param  string $licenseKey
     * @param  string $login
     * @param  string $password
     * @return string|null
     */
    public function getTokenByLogin(string $licenseKey, string $login, string $password): ?string;

    /**
     * Store JWT by PIN-code.
     *
     * @param  string      $licenseKey
     * @param  string      $pinCode
     * @param  string|null $token
     * @return void
     */
    public function setTokenByPin(string $licenseKey, string $pinCode, ?string $token): void;

    /**
     * Store JWT by login & password.
     *
     * @param  string      $licenseKey
     * @param  string      $login
     * @param  string      $password
     * @param  string|null $token
     * @return void
     */
    public function setTokenByLogin(string $licenseKey, string $login, string $password, ?string $token): void;

    /**
     * Delete JWT by PIN-code.
     *
     * @param  string $licenseKey
     * @param  string $pinCode
     * @return void
     */
    public function deleteTokenByPin(string $licenseKey, string $pinCode): void;

    /**
     * Delete JWT by login & password.
     *
     * @param  string      $licenseKey
     * @param  string      $login
     * @param  string      $password
     * @return void
     */
    public function deleteTokenByLogin(string $licenseKey, string $login, string $password): void;
}
