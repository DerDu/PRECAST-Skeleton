<?php

namespace PRECAST\Vendor\Factory\Adapter;

use phpFastCache\CacheManager;
use phpFastCache\Exceptions\phpFastCacheInvalidArgumentException;
use phpFastCache\Helper\Psr16Adapter;
use PRECAST\Vendor\Factory\AbstractAdapter;
use PRECAST\Vendor\Factory\Contract\CacheInterface;

/**
 * Class PhpFastCache
 * @package PRECAST\Vendor\Factory\Adapter
 */
class PhpFastCache extends AbstractAdapter implements CacheInterface
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
     * @param string $Key
     * @param mixed $Value
     * @param null|int $Timeout
     * @param string $Region
     * @return CacheInterface
     * @throws \Exception
     */
    public function setValue($Key, $Value, $Timeout = null, $Region = 'Generic'): CacheInterface
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
        //$this->useDriver()->set($this->buildKey($Key, $Region), $Value, $Timeout);
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
     * @param string $Key
     * @param string $Region
     * @return mixed|null
     */
    public function getValue($Key, $Region = 'Generic')
    {
        return $this->useDriver()->get($this->buildKey($Key, $Region), null);
    }

    /**
     * @param string $Key
     * @param string $Region
     * @return CacheInterface
     */
    public function clearValue($Key, $Region = 'Generic'): CacheInterface
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
     * @return CacheInterface
     */
    public function clearCache()
    {
        $this->useDriver()->clear();
        return $this;
    }
}
