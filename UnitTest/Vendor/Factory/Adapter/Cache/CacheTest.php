<?php

namespace PRECAST\Vendor\Factory\Adapter\Cache;

use PRECAST\TestHelper;

/**
 * Class CacheTest
 * @package PRECAST\Vendor\Factory\Adapter\Cache
 */
class CacheTest extends TestHelper
{
    public function testFileAdapter()
    {
        $this->CacheInterface( new FileCache() );
    }

    public function testMemoryAdapter()
    {
        $this->CacheInterface(new MemoryCache());
    }

    public function testMemcachedAdapter()
    {
        $this->CacheInterface(new MemcachedCache());
    }

    public function testZendMemoryAdapter()
    {
        $this->CacheInterface(new ZendMemoryCache());
    }

    public function testMemStaticAdapter()
    {
        $this->CacheInterface(new MemStaticCache());
    }
}
