<?php

namespace PRECAST\Vendor\Factory\Contract;

/**
 * Interface CacheInterface
 * @package PRECAST\Vendor\Factory\Contract
 */
interface CacheInterface
{
    /**
     * @param string $Key
     * @param mixed $Value
     * @param string $Region
     * @return CacheInterface
     */
    public function setValue($Key, $Value, $Region = ''): CacheInterface;

    /**
     * @param string $Key
     * @param string $Region
     * @return mixed
     */
    public function getValue($Key, $Region = '');
}
