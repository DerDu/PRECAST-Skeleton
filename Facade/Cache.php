<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Factory\Contract\CacheInterface;

/**
 * Class Cache
 * @package PRECAST\Facade
 */
class Cache
{
    /**
     * @return null|CacheInterface
     */
    public static function Package(): CacheInterface
    {
        return (new \PRECAST\Vendor\Factory\Package\Cache())->getPackage();
    }
}
