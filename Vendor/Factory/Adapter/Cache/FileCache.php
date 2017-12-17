<?php

namespace PRECAST\Vendor\Factory\Adapter\Cache;


use PRECAST\Vendor\Factory\Adapter\Cache\Contract\FileCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\PhpFastCache;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class FileCache
 * @package PRECAST\Vendor\Factory\Adapter
 */
class FileCache extends PhpFastCache implements AdapterInterface, FileCacheInterface
{
    /**
     * FileCache constructor.
     */
    public function __construct()
    {
        $this->setDriver('Files');
    }
}
