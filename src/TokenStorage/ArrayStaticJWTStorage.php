<?php

namespace DigitSoft\Checkbox\TokenStorage;

/**
 * Basic storage which saves data into static property.
 */
class ArrayStaticJWTStorage extends BaseJWTStorage
{
    /**
     * Associative array with data
     * @var string[]
     */
    protected static array $storage = [];

    /**
     * {@inheritdoc}
     */
    public function getTokenByPin(string $licenseKey, string $pinCode): ?string
    {
        $key = $this->getStorageKeyForPinCode($licenseKey, $pinCode);

        return static::$storage[$key] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenByLogin(string $licenseKey, string $login, string $password): ?string
    {
        $key = $this->getStorageKeyForLogin($licenseKey, $login, $password);

        return static::$storage[$key] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function setTokenByPin(string $licenseKey, string $pinCode, ?string $token): void
    {
        $key = $this->getStorageKeyForPinCode($licenseKey, $pinCode);

        if ($token === null) {
            unset(static::$storage[$key]);
            return;
        }

        static::$storage[$key] = $token;
    }

    /**
     * {@inheritdoc}
     */
    public function setTokenByLogin(string $licenseKey, string $login, string $password, ?string $token): void
    {
        $key = $this->getStorageKeyForLogin($licenseKey, $login, $password);

        if ($token === null) {
            unset(static::$storage[$key]);
            return;
        }

        static::$storage[$key] = $token;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteTokenByPin(string $licenseKey, string $pinCode): void
    {
        $key = $this->getStorageKeyForPinCode($licenseKey, $pinCode);
        unset(static::$storage[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteTokenByLogin(string $licenseKey, string $login, string $password): void
    {
        $key = $this->getStorageKeyForLogin($licenseKey, $login, $password);
        unset(static::$storage[$key]);
    }
}
