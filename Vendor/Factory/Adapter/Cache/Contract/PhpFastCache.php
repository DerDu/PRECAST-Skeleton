<?php

namespace PRECAST\Vendor\Factory\Adapter\Cache\Contract;


use phpFastCache\CacheManager;
use phpFastCache\Exceptions\phpFastCacheInvalidArgumentException;
use phpFastCache\Helper\Psr16Adapter;
use PRECAST\Vendor\Factory\Contract\CacheInterface;

/**
 * Class PhpFastCache
 * @package PRECAST\Vendor\Factory\Adapter
 */
abstract class PhpFastCache implements CacheInterface
{
    /** @var null|\phpFastCache\Core\Pool\ExtendedCacheItemPoolInterface $ExtendedInterface */
    private static $ExtendedInterface = null;
    /** @var null|Psr16Adapter $SimpleInterface */
    private static $SimpleInterface = null;
    /** @var string $Driver */
    private $Driver = 'files';
    /** @var array $Config */
    private $Config = [
        'ignoreSymfonyNotice' => true,
        'fallback' => 'files',
        'compress_data' => true,
        'preventCacheSlams' => true
    ];

    /**
     * @inheritdoc
     */
    public function set($Key, $Value, $Timeout = null, $Region = 'Generic'): CacheInterface
    {
        $Cache = $this->useDriver(true);
        try {
            $Item = $Cache
                ->getItem($this->buildKey($Key, $Region))
                ->addTag($this->buildRegion($Region))
                ->set($Value);
            if (is_int($Timeout) && $Timeout <= 0) {
                $Item->expiresAt((new \DateTime('@0')));
            } elseif (is_int($Timeout) || $Timeout instanceof \DateInterval) {
                $Item->expiresAfter($Timeout);
            }
            $Cache->save($Item);
        } catch (phpFastCacheInvalidArgumentException $Exception) {
            throw new \Exception($Exception->getMessage(), null, $Exception);
        }
        return $this;
    }

    /**
     * @param bool $Extended false
     * @return \phpFastCache\Core\Pool\ExtendedCacheItemPoolInterface|Psr16Adapter
     */
    private function useDriver($Extended = false)
    {
        if ($Extended) {
            if (null === self::$ExtendedInterface) {
                self::$ExtendedInterface = CacheManager::getInstance($this->Driver, $this->Config);
            }
            return self::$ExtendedInterface;
        }
        if (null === self::$SimpleInterface) {
            self::$SimpleInterface = new Psr16Adapter($this->Driver, $this->Config);
        }
        return self::$SimpleInterface;
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
     * @param string $Region
     * @return string
     */
    private function buildRegion($Region)
    {
        return 'Region#' . crc32($Region);
    }

    /**
     * @inheritdoc
     */
    public function get($Key, $Default = null, $Region = 'Generic')
    {
        return $this->useDriver()->get($this->buildKey($Key, $Region), $Default);
    }

    /**
     * @inheritdoc
     */
    public function delete($Key, $Region = 'Generic'): CacheInterface
    {
        $this->useDriver()->delete($this->buildKey($Key, $Region));
        return $this;
    }

    /**
     * @param string $Region
     * @return CacheInterface
     * @throws \Exception
     */
    public function clearRegion($Region = 'Generic'): CacheInterface
    {
        $Cache = $this->useDriver(true);
        try {
            $Cache->deleteItemsByTag($this->buildRegion($Region));
        } catch (phpFastCacheInvalidArgumentException $Exception) {
            throw new \Exception($Exception->getMessage(), null, $Exception);
        }
        return $this;
    }

    /**
     * @inheritdoc
     * @return CacheInterface
     */
    public function clear()
    {
        $this->useDriver()->clear();
        return $this;
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

    /**
     * @inheritdoc
     */
    public function has($Key, $Region = '')
    {
        return $this->useDriver()->has($this->buildKey($Key, $Region));
    }

    /**
     * @param string $Driver
     * @return PhpFastCache
     */
    protected function setDriver(string $Driver): PhpFastCache
    {
        $this->Driver = $Driver;
        return $this;
    }
}
