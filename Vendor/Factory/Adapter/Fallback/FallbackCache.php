<?php

namespace PRECAST\Vendor\Factory\Adapter\Fallback;


use PRECAST\Vendor\Factory\Contract\CacheInterface;
use PRECAST\Vendor\Factory\FallbackAdapterInterface;

/**
 * Class FallbackCache
 * @package PRECAST\Vendor\Factory\Adapter\Fallback
 */
class FallbackCache implements CacheInterface, FallbackAdapterInterface
{
    /** @var array[][] $MemoryCache */
    private static $MemoryCache = [];

    /**
     * @inheritdoc
     */
    public function set($Key, $Value, $Timeout = null, $Region = ''): CacheInterface
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
     * @return CacheInterface
     */
    public function delete($Key, $Region = ''): CacheInterface
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
     * @inheritdoc
     */
    public function clear(): CacheInterface
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
