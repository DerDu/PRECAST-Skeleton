<?php

namespace PRECAST\Vendor\Factory\Adapter\Cache;


use PRECAST\Vendor\Factory\Adapter\Cache\Contract\MemcachedCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\PhpFastCache;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class MemcachedCache
 * @package PRECAST\Vendor\Factory\Adapter\Cache
 */
class MemcachedCache extends PhpFastCache implements AdapterInterface, MemcachedCacheInterface
{
    /**
     * MemcachedCache constructor.
     */
    public function __construct()
    {
        $this->setDriver('Memcached');
    }
}
