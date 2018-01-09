<?php

namespace PRECAST\Vendor\Factory\Adapter\Fallback;


use PRECAST\Vendor\Factory\Adapter\Cache\Contract\RootCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;

/**
 * Class FallbackCache
 * @package PRECAST\Vendor\Factory\Adapter\Fallback
 */
class FallbackCache implements RootCacheInterface, RootFallbackInterface
{
    /** @var array[][] $MemoryCache */
    private static $MemoryCache = [];

    /**
     * @inheritdoc
     */
    public function set($Key, $Value, $Timeout = null, $Region = ''): RootCacheInterface
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
     * @inheritdoc
     */
    public function get($Key, $Default = null, $Region = '')
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
     * @inheritdoc
     * @return RootCacheInterface
     */
    public function delete($Key, $Region = ''): RootCacheInterface
    {
        unset(self::$MemoryCache[$this->buildRegion($Region)][$this->buildKey($Key, $Region)]);
        return $this;
    }

    /**
     * @param string $Region
     * @return RootCacheInterface
     */
    public function clearRegion($Region = ''): RootCacheInterface
    {
        unset(self::$MemoryCache[$this->buildRegion($Region)]);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function clear(): RootCacheInterface
    {
        self::$MemoryCache = [];
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function has($Key, $Region = '')
    {
        return isset(self::$MemoryCache[$this->buildRegion($Region)][$this->buildKey($Key, $Region)]);
    }

    /**
     * @inheritdoc
     */
    public function getMultiple($Keys, $Default = null)
    {
        // TODO: Implement getMultiple() method.
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritdoc
     */
    public function setMultiple($Values, $TTL = null)
    {
        // TODO: Implement setMultiple() method.
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritdoc
     */
    public function deleteMultiple($Keys)
    {
        // TODO: Implement deleteMultiple() method.
        throw new \Exception('Not implemented');
    }
}
