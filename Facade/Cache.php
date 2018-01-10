<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Factory;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\FileCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\MemcachedCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\MemoryCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\RootCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class Cache
 * @package PRECAST\Facade
 */
class Cache
{
    const TYPE_MEMORY = 0;
    const TYPE_FILES = 1;
    const TYPE_MEMCACHED = 2;

    /**
     * @param int $Type
     * @return AdapterInterface
     */
    public static function createInstance(int $Type = Cache::TYPE_MEMORY)
    {
        $Factory = new Factory();

        switch ($Type) {
            case self::TYPE_MEMORY:
                return $Factory->createAdapter(
                    RootCacheInterface::class,
                    MemoryCacheInterface::class
                );
            case self::TYPE_FILES:
                return $Factory->createAdapter(
                    RootCacheInterface::class,
                    FileCacheInterface::class
                );
            case self::TYPE_MEMCACHED:
                return $Factory->createAdapter(
                    RootCacheInterface::class,
                    MemcachedCacheInterface::class
                );
            default:
                return $Factory->createAdapter(
                    RootCacheInterface::class,
                    RootFallbackInterface::class
                );
        }
    }
}
