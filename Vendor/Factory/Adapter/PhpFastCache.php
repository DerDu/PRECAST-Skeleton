<?php

namespace PRECAST\Vendor\Factory\Adapter;

use PRECAST\Vendor\Factory\AbstractAdapter;
use PRECAST\Vendor\Factory\Contract\CacheInterface;

/**
 * Class PhpFastCache
 * @package PRECAST\Vendor\Factory\Adapter
 */
class PhpFastCache extends AbstractAdapter implements CacheInterface
{
    public function setValue($Key, $Value, $Region = ''): CacheInterface
    {
        return $this;
    }

    public function getValue($Key, $Region = '')
    {

    }
}
