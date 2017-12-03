<?php

namespace PRECAST;

use PHPUnit\Framework\TestCase;
use PRECAST\Vendor\Factory\AbstractAdapter;
use PRECAST\Vendor\Factory\Contract\CacheInterface;

/**
 * Class TestHelper
 * @package PRECAST
 */
class TestHelper extends TestCase
{
    /**
     * @param CacheInterface $MockUp
     */
    protected function PrecastCacheInterface( CacheInterface $MockUp )
    {

        $this->assertInstanceOf( AbstractAdapter::class, $MockUp );

        $MockUp->clearCache();

        $Key0 = 'Key0';
        $Key1 = 'Key1';
        $Key2 = 'Key2';

        $Region0 = 'Generic';
        $Region1 = 'Region1';
        $Region2 = 'Region2';

        $Value0 = 'Value0';
        $Value1 = 'Value1';
        $Value2 = 'Value2';

        $this->assertEmpty( $MockUp->getValue( $Key0, $Region0 ) );
        $this->assertEmpty( $MockUp->getValue( $Key1, $Region0 ) );
        $this->assertEmpty( $MockUp->getValue( $Key2, $Region0 ) );

        $this->assertEmpty( $MockUp->getValue( $Key0, $Region1 ) );
        $this->assertEmpty( $MockUp->getValue( $Key1, $Region1 ) );
        $this->assertEmpty( $MockUp->getValue( $Key2, $Region1 ) );

        $this->assertEmpty( $MockUp->getValue( $Key0, $Region2 ) );
        $this->assertEmpty( $MockUp->getValue( $Key1, $Region2 ) );
        $this->assertEmpty( $MockUp->getValue( $Key2, $Region2 ) );

        $MockUp->setValue( $Key0, $Value0, null, $Region0 );

        $this->assertEquals( $Value0, $MockUp->getValue( $Key0, $Region0 ) );
        $this->assertEmpty( $MockUp->getValue( $Key1, $Region0 ) );
        $this->assertEmpty( $MockUp->getValue( $Key2, $Region0 ) );

        $this->assertEmpty( $MockUp->getValue( $Key0, $Region1 ) );
        $this->assertEmpty( $MockUp->getValue( $Key1, $Region1 ) );
        $this->assertEmpty( $MockUp->getValue( $Key2, $Region1 ) );

        $this->assertEmpty( $MockUp->getValue( $Key0, $Region2 ) );
        $this->assertEmpty( $MockUp->getValue( $Key1, $Region2 ) );
        $this->assertEmpty( $MockUp->getValue( $Key2, $Region2 ) );

        $MockUp->setValue( $Key1, $Value1, null, $Region1 );

        $this->assertEquals( $Value0, $MockUp->getValue( $Key0, $Region0 ) );
        $this->assertEmpty( $MockUp->getValue( $Key1, $Region0 ) );
        $this->assertEmpty( $MockUp->getValue( $Key2, $Region0 ) );

        $this->assertEmpty( $MockUp->getValue( $Key0, $Region1 ) );
        $this->assertEquals( $Value1, $MockUp->getValue( $Key1, $Region1 ) );
        $this->assertEmpty( $MockUp->getValue( $Key2, $Region1 ) );

        $this->assertEmpty( $MockUp->getValue( $Key0, $Region2 ) );
        $this->assertEmpty( $MockUp->getValue( $Key1, $Region2 ) );
        $this->assertEmpty( $MockUp->getValue( $Key2, $Region2 ) );

        $MockUp->setValue( $Key2, $Value2, null, $Region2 );

        $this->assertEquals( $Value0, $MockUp->getValue( $Key0, $Region0 ) );
        $this->assertEmpty( $MockUp->getValue( $Key1, $Region0 ) );
        $this->assertEmpty( $MockUp->getValue( $Key2, $Region0 ) );

        $this->assertEmpty( $MockUp->getValue( $Key0, $Region1 ) );
        $this->assertEquals( $Value1, $MockUp->getValue( $Key1, $Region1 ) );
        $this->assertEmpty( $MockUp->getValue( $Key2, $Region1 ) );

        $this->assertEmpty( $MockUp->getValue( $Key0, $Region2 ) );
        $this->assertEmpty( $MockUp->getValue( $Key1, $Region2 ) );
        $this->assertEquals( $Value2, $MockUp->getValue( $Key2, $Region2 ) );

    }
}
