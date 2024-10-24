<?php

namespace DigitSoft\Checkbox\TokenStorage;

/**
 * JWT store for cache in Laravel app.
 */
class LaravelCacheJWTStorage extends CacheJWTStorage
{
    /**
     * @param  string|null $cacheStoreName
     * @param  int         $ttl
     * @param  string      $keyPrefix
     */
    public function __construct(?string $cacheStoreName = null, int $ttl = 864000, string $keyPrefix = 'chb_t__')
    {
        parent::__construct(
            \Illuminate\Support\Facades\Cache::store($cacheStoreName),
            $ttl,
            $keyPrefix
        );
    }
}
