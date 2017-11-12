<?php

namespace Vendor\Adapter;

use Vendor\AbstractAdapter;
use Vendor\AdapterInterface;
use Vendor\Bundle\CacheInterface;

/**
 * Class PhpFastCacheAdapter
 * @package Vendor\Adapter
 */
class PhpFastCacheAdapter extends AbstractAdapter implements CacheInterface
{
    /**
     * @return AdapterInterface
     */
    public function createAdapter(): AdapterInterface
    {
        print __METHOD__ . PHP_EOL;
        return $this;
    }

    public function setValue( $Key, $Value, $Region = '' )
    {

    }

    public function getValue( $Key, $Region = '' )
    {

    }
}
