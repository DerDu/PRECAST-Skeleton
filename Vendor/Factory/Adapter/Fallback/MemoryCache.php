<?php

namespace PRECAST\Vendor\Factory\Adapter\Fallback;


use PRECAST\Vendor\Factory\Adapter\Generic\AbstractCache;
use PRECAST\Vendor\Factory\Contract\CacheInterface;
use PRECAST\Vendor\Factory\FallbackAdapterInterface;

/**
 * Class MemoryCache
 * @package PRECAST\Vendor\Factory\Adapter\Fallback
 */
class MemoryCache extends AbstractCache implements FallbackAdapterInterface
{
    /** @var array[][] $MemoryCache */
    private static $MemoryCache = [];

    /**
     * @param string $Key
     * @param mixed $Value
     * @param null|int $Timeout
     * @param string $Region
     * @return CacheInterface
     */
    public function setValue($Key, $Value, $Timeout = null, $Region = ''): CacheInterface
    {
        self::$MemoryCache[$this->buildRegion($Region)][$this->buildKey($Key, $Region)] = [
            'TTL' => time() + $Timeout,
            'V' => $Value
        ];
        return $this;
    }

    /**
     * @param string $Region
     * @return string
     */
    private function buildRegion($Region)
    {
        return 'Region#' . crc32($Region);
    }

    /**
     * @param string $Key
     * @param string $Region
     * @return string
     */
    private function buildKey($Key, $Region)
    {
        return 'Key#' . crc32($Region) . '#' . crc32($Key);
    }

    /**
     * @param string $Key
     * @param string $Region
     * @return mixed|null
     */
    public function getValue($Key, $Region = '')
    {
        if (isset(self::$MemoryCache[$this->buildRegion($Region)][$this->buildKey($Key, $Region)])) {
            $Value = self::$MemoryCache[$this->buildRegion($Region)][$this->buildKey($Key, $Region)];
            if ($Value['TTL'] >= time()) {
                return $Value['V'];
            } else {
                unset(self::$MemoryCache[$this->buildRegion($Region)][$this->buildKey($Key, $Region)]);
            }
        }
        return null;
    }

    /**
     * @param string $Key
     * @param string $Region
     * @return CacheInterface
     */
    public function clearValue($Key, $Region = ''): CacheInterface
    {
        unset(self::$MemoryCache[$this->buildRegion($Region)][$this->buildKey($Key, $Region)]);
        return $this;
    }

    /**
     * @param string $Region
     * @return CacheInterface
     */
    public function clearRegion($Region = ''): CacheInterface
    {
        unset(self::$MemoryCache[$this->buildRegion($Region)]);
        return $this;
    }

    /**
     * @return CacheInterface
     */
    public function clearCache()
    {
        self::$MemoryCache = [];
        return $this;
    }
}
