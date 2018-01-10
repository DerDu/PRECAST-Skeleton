<?php

namespace PRECAST\Vendor\Factory\Adapter\Cache;


use PRECAST\Vendor\Factory\Adapter\Cache\Contract\MemcachedCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\AbstractPhpFastCache;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class MemcachedCache
 * @package PRECAST\Vendor\Factory\Adapter\Cache
 */
class MemcachedCache extends AbstractPhpFastCache implements AdapterInterface, MemcachedCacheInterface
{
    /**
     * MemcachedCache constructor.
     */
    public function __construct()
    {
        $this->setDriver('Memcached');
    }
}
