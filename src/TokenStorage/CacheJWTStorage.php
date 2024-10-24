<?php

namespace DigitSoft\Checkbox\TokenStorage;

use Psr\SimpleCache\CacheInterface;

class CacheJWTStorage extends BaseJWTStorage
{
    protected CacheInterface $cache;
    protected int $ttl;
    protected string $keyPrefix;

    public function __construct(CacheInterface $cache, int $ttl = 864000, string $keyPrefix = 'chb_t__')
    {
        $this->cache = $cache;
        $this->ttl = $ttl;
        $this->keyPrefix = $keyPrefix;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenByPin(string $licenseKey, string $pinCode): ?string
    {
        $storageKey = $this->getStorageKeyForPinCode($licenseKey, $pinCode, $this->keyPrefix);

        return $this->cache->get($storageKey);
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenByLogin(string $licenseKey, string $login, string $password): ?string
    {
        $storageKey = $this->getStorageKeyForLogin($licenseKey, $login, $password, $this->keyPrefix);

        return $this->cache->get($storageKey);
    }

    /**
     * {@inheritdoc}
     */
    public function setTokenByPin(string $licenseKey, string $pinCode, ?string $token): void
    {
        $storageKey = $this->getStorageKeyForPinCode($licenseKey, $pinCode, $this->keyPrefix);
        if ($token === null) {
            $this->cache->delete($storageKey);
        }

        $this->cache->set($storageKey, $token, $this->ttl);
    }

    /**
     * {@inheritdoc}
     */
    public function setTokenByLogin(string $licenseKey, string $login, string $password, ?string $token): void
    {
        $storageKey = $this->getStorageKeyForLogin($licenseKey, $login, $password, $this->keyPrefix);
        if ($token === null) {
            $this->cache->delete($storageKey);
        }

        $this->cache->set($storageKey, $token, $this->ttl);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteTokenByPin(string $licenseKey, string $pinCode): void
    {
        $storageKey = $this->getStorageKeyForPinCode($licenseKey, $pinCode, $this->keyPrefix);
        $this->cache->delete($storageKey);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteTokenByLogin(string $licenseKey, string $login, string $password): void
    {
        $storageKey = $this->getStorageKeyForLogin($licenseKey, $login, $password, $this->keyPrefix);
        $this->cache->delete($storageKey);
    }
}
