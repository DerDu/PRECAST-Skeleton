<?php

namespace PRECAST\Vendor\Factory\Contract;

use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Interface CacheInterface
 * @package PRECAST\Vendor\Factory\Contract
 */
interface CacheInterface extends AdapterInterface
{
    /**
     * @param string $Key
     * @param mixed $Value
     * @param null|int $Timeout
     * @param string $Region
     * @return CacheInterface
     */
    public function setValue($Key, $Value, $Timeout = null, $Region = ''): CacheInterface;

    /**
     * @param string $Key
     * @param string $Region
     * @return mixed|null
     */
    public function getValue($Key, $Region = '');

    /**
     * @param string $Key
     * @param string $Region
     * @return CacheInterface
     */
    public function clearValue($Key, $Region = ''): CacheInterface;

    /**
     * @param string $Region
     * @return CacheInterface
     */
    public function clearRegion($Region = ''): CacheInterface;

    /**
     * @return CacheInterface
     */
    public function clearCache();
}
