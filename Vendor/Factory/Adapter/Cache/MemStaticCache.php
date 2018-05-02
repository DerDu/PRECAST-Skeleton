<?php

namespace PRECAST\Vendor\Factory\Adapter\Cache;


use PRECAST\Vendor\Factory\Adapter\Cache\Contract\AbstractPhpFastCache;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\MemStaticCacheInterface;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class MemStaticCache
 * @package PRECAST\Vendor\Factory\Adapter
 */
class MemStaticCache extends AbstractPhpFastCache implements AdapterInterface, MemStaticCacheInterface
{
    /**
     * MemStaticCache constructor.
     */
    public function __construct()
    {
        $this->setDriver('Memstatic');
    }
}
