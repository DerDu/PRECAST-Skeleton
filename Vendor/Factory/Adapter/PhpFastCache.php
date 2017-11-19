<?php

namespace PRECAST\Vendor\Factory\Adapter;

use phpFastCache\Helper\Psr16Adapter;
use PRECAST\Vendor\Factory\AbstractAdapter;
use PRECAST\Vendor\Factory\Contract\CacheInterface;

/**
 * Class PhpFastCache
 * @package PRECAST\Vendor\Factory\Adapter
 */
class PhpFastCache extends AbstractAdapter implements CacheInterface
{
    /**
     * @param string $Key
     * @param mixed $Value
     * @param null|int $Timeout
     * @param string $Region
     * @return CacheInterface
     */
    public function setValue($Key, $Value, $Timeout = null, $Region = ''): CacheInterface
    {
        $Cache = new Psr16Adapter('files', ['ignoreSymfonyNotice' => true]);
        $Cache->set(crc32($Region) . '-' . crc32($Key), $Value, $Timeout);
        return $this;
    }

    /**
     * @param string $Key
     * @param string $Region
     * @return mixed|null
     */
    public function getValue($Key, $Region = '')
    {
        $Cache = new Psr16Adapter('files', ['ignoreSymfonyNotice' => true]);
        return $Cache->get(crc32($Region) . '-' . crc32($Key), null);
    }
}
