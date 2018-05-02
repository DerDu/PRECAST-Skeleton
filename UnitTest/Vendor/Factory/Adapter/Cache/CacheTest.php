<?php

namespace PRECAST\Vendor\Factory\Adapter\Cache;

use PRECAST\TestHelper;

/**
 * Class CacheTest
 * @package PRECAST\Vendor\Factory\Adapter\Cache
 */
class CacheTest extends TestHelper
{
    /**
     * @throws \Exception
     */
    public function testFileAdapter()
    {
        $this->CacheInterface(new FileCache());
    }

    /**
     * @throws \Exception
     */
    public function testMemoryAdapter()
    {
        $this->CacheInterface(new MemoryCache());
    }

    /**
     * @throws \Exception
     */
    public function testMemcachedAdapter()
    {
        $this->CacheInterface(new MemcachedCache());
    }

    /**
     * @throws \Exception
     */
    public function testZendMemoryAdapter()
    {
        $this->CacheInterface(new ZendMemoryCache());
    }

    /**
     * @throws \Exception
     */
    public function testMemStaticAdapter()
    {
        $this->CacheInterface(new MemStaticCache());
    }
}
