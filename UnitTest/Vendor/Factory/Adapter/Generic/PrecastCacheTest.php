<?php

namespace PRECAST\Vendor\Factory\Adapter\Generic;

use PRECAST\TestHelper;

/**
 * Class PrecastCacheTest
 * @package PRECAST\Vendor\Factory\Adapter\Generic
 */
class PrecastCacheTest extends TestHelper
{
    public function testAdapterInterface()
    {
        $this->PrecastCacheInterface(new PrecastCache());
    }
}
