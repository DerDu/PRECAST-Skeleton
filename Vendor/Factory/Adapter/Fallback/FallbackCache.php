<?php

namespace PRECAST\Vendor\Factory\Adapter\Fallback;


use PRECAST\Vendor\Factory\Adapter\Cache\Contract\RootCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\MemoryCache;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;

/**
 * Class FallbackCache
 * @package PRECAST\Vendor\Factory\Adapter\Fallback
 */
class FallbackCache extends MemoryCache implements RootCacheInterface, RootFallbackInterface
{

}
