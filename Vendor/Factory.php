<?php

namespace PRECAST\Vendor;

use PRECAST\Vendor\Exception\AdapterException;
use PRECAST\Vendor\Exception\FactoryException;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\RootCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\FileCache;
use PRECAST\Vendor\Factory\Adapter\Cache\MemoryCache;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;
use PRECAST\Vendor\Factory\AdapterInterface;
use PRECAST\Vendor\Factory\FactoryInterface;

/**
 * Class Factory
 * @package PRECAST\Vendor
 */
class Factory
{
    /** @var null|RootCacheInterface */
    private static $CacheAdapter = null;
    /** @var string $AdapterDirectory */
    private $AdapterDirectory = 'Vendor/Factory/Adapter';
    /** @var array $FallbackAdapters */
    private $FallbackAdapters = [];
    /** @var array $Adapters */
    private $Adapters = [];

    /**
     * Factory constructor.
     * @param null|RootCacheInterface $CacheAdapter
     * @throws FactoryException
     */
    public function __construct(RootCacheInterface $CacheAdapter = null)
    {
        if ($CacheAdapter === null) {
            self::$CacheAdapter = new FileCache();
        } else {
            self::$CacheAdapter = $CacheAdapter;
        }
        try {
            $this->loadAvailableAdapter();
        } catch (\Throwable $throwable) {
            throw new FactoryException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * @throws FactoryException
     */
    private function loadAvailableAdapter()
    {
        try {
            $this->Adapters = self::$CacheAdapter->get(__METHOD__ . '#Adapters');
        } catch (\Exception $exception) {
            throw new FactoryException($exception->getMessage(), $exception->getCode(), $exception);
        }
        try {
            $this->FallbackAdapters = self::$CacheAdapter->get(__METHOD__ . '#FallbackAdapters');
        } catch (\Exception $exception) {
            throw new FactoryException($exception->getMessage(), $exception->getCode(), $exception);
        }

        if (empty($this->Adapters)) {
            $RDI = new \RecursiveDirectoryIterator(
                $this->AdapterDirectory,
                \RecursiveDirectoryIterator::SKIP_DOTS
            );
            $RII = new \RecursiveIteratorIterator(
                $RDI,
                \RecursiveIteratorIterator::SELF_FIRST,
                \RecursiveIteratorIterator::CATCH_GET_CHILD
            );

            /** @var \SplFileInfo $Item */
            foreach ($RII as $Item) {
                if ($Item->isDir()) {
                    continue;
                }
                $Class = str_replace('/', '\\',
                    'PRECAST' . DIRECTORY_SEPARATOR .
                    $Item->getPath() . DIRECTORY_SEPARATOR .
                    basename($Item->getFilename(), '.php')
                );
                try {
                    $Reflection = new \ReflectionClass($Class);
                } catch (\ReflectionException $exception) {
                    throw new FactoryException($exception->getMessage(), $exception->getCode(), $exception);
                }

                if (!$Reflection->isInterface()) {
                    if ($Reflection->implementsInterface(RootFallbackInterface::class)) {
                        $this->FallbackAdapters[$Class] = $Reflection->getInterfaceNames();
                        sort($this->FallbackAdapters[$Class]);
                    } else {
                        if ($Reflection->implementsInterface(AdapterInterface::class)) {
                            $this->Adapters[$Class] = $Reflection->getInterfaceNames();
                            sort($this->Adapters[$Class]);
                        }
                    }
                }
            }

            ksort($this->Adapters);
            ksort($this->FallbackAdapters);

            try {
                self::$CacheAdapter->set(__METHOD__ . '#Adapters', $this->Adapters, 10);
            } catch (\Exception $exception) {
                throw new FactoryException($exception->getMessage(), $exception->getCode(), $exception);
            }
            try {
                self::$CacheAdapter->set(__METHOD__ . '#FallbackAdapters', $this->FallbackAdapters, 10);
            } catch (\Exception $exception) {
                throw new FactoryException($exception->getMessage(), $exception->getCode(), $exception);
            }
        }
    }

    /**
     * @param string[] ...$factoryInterfaces
     * @return null|AdapterInterface
     * @throws FactoryException
     * @throws AdapterException
     */
    public function createAdapter(string... $factoryInterfaces)
    {
        if (empty($factoryInterfaces)) {
            throw new FactoryException('No Factory Interface given');
        }
        $Adapter = $this->findAdapter($factoryInterfaces);
        return new $Adapter;
    }

    /**
     * @param  array $factoryInterfaces
     * @return null|string
     * @throws FactoryException
     * @throws AdapterException
     */
    private function findAdapter(array $factoryInterfaces)
    {
        $this->validateFactoryInterfaces($factoryInterfaces);

        $Cache = new MemoryCache();

        $Adapter = $Cache->get(implode($factoryInterfaces));
        if (empty($Adapter)) {
            foreach ($this->Adapters as $Adapter => $adapterInterfaces) {
                if (count(array_intersect($adapterInterfaces, $factoryInterfaces)) == count($factoryInterfaces)) {
                    $Cache->set(implode($factoryInterfaces), $Adapter, 30);
                    return $Adapter;
                }
            }
        } else {
            return $Adapter;
        }

        $Adapter = $Cache->get(implode($factoryInterfaces));
        if (empty($Adapter)) {
            foreach ($this->FallbackAdapters as $Adapter => $adapterInterfaces) {
                if (count(array_intersect($adapterInterfaces, $factoryInterfaces)) == count($factoryInterfaces)) {
                    $Cache->set(implode($factoryInterfaces), $Adapter, 30);
                    return $Adapter;
                }
            }
        } else {
            return $Adapter;
        }

        throw new FactoryException('No suitable Adapter found for ' . implode(', ', $factoryInterfaces));
    }

    /**
     * @param array $factoryInterfaces
     * @throws FactoryException
     * @throws AdapterException
     */
    private function validateFactoryInterfaces(array $factoryInterfaces)
    {
        $Cache = new FileCache();
        if (!empty($factoryInterface = $Cache->get(implode($factoryInterfaces), null, __METHOD__))) {
            throw new FactoryException($factoryInterface . ' was not a Factory Interface');
        }

        foreach ($factoryInterfaces as $factoryInterface) {
            if (!$this->isFactoryInterface($factoryInterface)) {
                $Cache->set(implode($factoryInterfaces), $factoryInterface, 30, __METHOD__);
                throw new FactoryException($factoryInterface . ' is not a Factory Interface');
            }
        }
    }

    /**
     * @param string $Interface
     * @return bool
     * @throws FactoryException
     * @throws AdapterException
     */
    private function isFactoryInterface(string $Interface)
    {
        $Cache = new FileCache();
        $isFactoryInterface = $Cache->get($Interface, null, __METHOD__);
        if (null === $isFactoryInterface) {
            try {
                $Reflection = new \ReflectionClass($Interface);
            } catch (\ReflectionException $exception) {
                throw new FactoryException($exception->getMessage(), $exception->getCode(), $exception);
            }
            $isFactoryInterface = $Reflection->implementsInterface(FactoryInterface::class);
            $Cache->set($Interface, $isFactoryInterface, 30, __METHOD__);
        }
        return $isFactoryInterface;
    }

    /**
     * @return array
     */
    public function getFallbackAdapters(): array
    {
        return array_keys($this->FallbackAdapters);
    }

    /**
     * @return array
     */
    public function getAdapters(): array
    {
        return array_keys($this->Adapters);
    }
}
