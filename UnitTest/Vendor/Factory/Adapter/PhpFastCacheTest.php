<?php

namespace PRECAST\Vendor\Factory\Adapter;

use PRECAST\TestHelper;

/**
 * Class PhpFastCacheTest
 * @package PRECAST\Vendor\Factory\Adapter
 */
class PhpFastCacheTest extends TestHelper
{
    public function testAdapterInterface()
    {
        $this->PrecastCacheInterface(new PhpFastCache());
    }
}
