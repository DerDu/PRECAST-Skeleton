<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Exception\FactoryException;
use PRECAST\Vendor\Factory;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\FileCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\MemcachedCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\MemoryCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\MemStaticCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\RootCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\ZendMemoryCacheInterface;
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
    const TYPE_ZEND_MEMORY = 3;
    const TYPE_MEM_STATIC = 4;

    /**
     * @param int $Type
     * @return AdapterInterface|RootCacheInterface
     * @throws FactoryException
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
            case self::TYPE_ZEND_MEMORY:
                return $Factory->createAdapter(
                    RootCacheInterface::class,
                    ZendMemoryCacheInterface::class
                );
            case self::TYPE_MEM_STATIC:
                return $Factory->createAdapter(
                    RootCacheInterface::class,
                    MemStaticCacheInterface::class
                );
            default:
                return $Factory->createAdapter(
                    RootCacheInterface::class,
                    RootFallbackInterface::class
                );
        }
    }
}
