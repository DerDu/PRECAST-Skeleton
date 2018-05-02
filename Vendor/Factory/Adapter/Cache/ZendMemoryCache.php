<?php

namespace PRECAST\Vendor\Factory\Adapter\Cache;


use PRECAST\Vendor\Factory\Adapter\Cache\Contract\AbstractPhpFastCache;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\ZendMemoryCacheInterface;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class ZendMemoryCache
 * @package PRECAST\Vendor\Factory\Adapter
 */
class ZendMemoryCache extends AbstractPhpFastCache implements AdapterInterface, ZendMemoryCacheInterface
{
    /**
     * ZendMemoryCache constructor.
     */
    public function __construct()
    {
        $this->setDriver('Zendshm');
    }
}
