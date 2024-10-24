<?php

namespace DigitSoft\Checkbox\TokenStorage;

abstract class BaseJWTStorage implements JWTStorage
{
    /**
     * Get a string key to use withing the storage (by PIN-code).
     *
     * @param  string $licenseKey
     * @param  string $pinCode
     * @param  string $prefix Optional prefix
     * @return string
     */
    protected function getStorageKeyForPinCode(string $licenseKey, string $pinCode, string $prefix = ''): string
    {
        return $prefix . sha1(implode(':', [$licenseKey, $pinCode]));
    }

    /**
     * Get a string key to use withing the storage (by login and password).
     *
     * @param  string $licenseKey
     * @param  string $login
     * @param  string $password
     * @param  string $prefix Optional prefix
     * @return string
     */
    protected function getStorageKeyForLogin(string $licenseKey, string $login, string $password, string $prefix = ''): string
    {
        return $prefix . sha1(implode(':', [$licenseKey, $login, $password]));
    }
}
