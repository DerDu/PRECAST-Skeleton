<?php

namespace PRECAST;

use PHPUnit\Framework\TestCase;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\RootCacheInterface;
use PRECAST\Vendor\Factory\AdapterInterface;
use PRECAST\Vendor\Factory\FactoryInterface;

/**
 * Class TestHelper
 * @package PRECAST
 */
class TestHelper extends TestCase
{
    /**
     * @param RootCacheInterface $MockUp
     * @throws \Exception
     */
    protected function CacheInterface(RootCacheInterface $MockUp)
    {

        $this->assertInstanceOf(AdapterInterface::class, $MockUp);
        $this->assertInstanceOf(FactoryInterface::class, $MockUp);

        $MockUp->clear();

        $Key0 = 'Key0';
        $Key1 = 'Key1';
        $Key2 = 'Key2';

        $Value0 = 'Value0';
        $Value1 = 'Value1';
        $Value2 = 'Value2';

        $this->assertEmpty($MockUp->get($Key0));
        $this->assertEmpty($MockUp->get($Key1));
        $this->assertEmpty($MockUp->get($Key2));

        $MockUp->set($Key0, $Value0, null);

        $this->assertEquals($Value0, $MockUp->get($Key0));

        $MockUp->set($Key1, $Value1, null);

        $this->assertEquals($Value0, $MockUp->get($Key0));
        $this->assertEquals($Value1, $MockUp->get($Key1));

        $MockUp->set($Key2, $Value2, null);

        $this->assertEquals($Value0, $MockUp->get($Key0));
        $this->assertEquals($Value1, $MockUp->get($Key1));
        $this->assertEquals($Value2, $MockUp->get($Key2));

    }
}
