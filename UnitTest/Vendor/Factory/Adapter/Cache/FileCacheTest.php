<?php
/**
 * Created by PhpStorm.
 * User: Kunze
 * Date: 17.12.2017
 * Time: 19:05
 */

namespace PRECAST\Vendor\Factory\Adapter\Cache;

use PRECAST\TestHelper;

class FileCacheTest extends TestHelper
{
    public function testAdapter()
    {
        $this->CacheInterface( new FileCache() );
    }
}
