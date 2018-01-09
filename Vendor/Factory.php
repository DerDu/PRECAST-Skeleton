<?php

namespace PRECAST\Vendor;

use PRECAST\Vendor\Factory\Adapter\Cache\Contract\RootCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Cache\FileCache;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;
use PRECAST\Vendor\Factory\Adapter\Fallback\FallbackCache;
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
     */
    public function __construct(RootCacheInterface $CacheAdapter = null)
    {
        if ($CacheAdapter === null) {
            self::$CacheAdapter = new FallbackCache();
        } else {
            self::$CacheAdapter = $CacheAdapter;
        }
        $this->loadAvailableAdapter();
    }

    /**
     *
     */
    private function loadAvailableAdapter()
    {
        $this->Adapters = self::$CacheAdapter->get(__METHOD__ . '#Adapters');
        $this->FallbackAdapters = self::$CacheAdapter->get(__METHOD__ . '#FallbackAdapters');

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
                $Reflection = new \ReflectionClass($Class);

                if( !$Reflection->isInterface() ) {
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

            self::$CacheAdapter->set(__METHOD__ . '#Adapters', $this->Adapters, 10);
            self::$CacheAdapter->set(__METHOD__ . '#FallbackAdapters', $this->FallbackAdapters, 10);
        }
    }

    /**
     * @param string[] ...$factoryInterfaces
     * @return AdapterInterface
     */
    public function createAdapter(string... $factoryInterfaces)
    {
        $Adapter = $this->findAdapter($factoryInterfaces);
        return new $Adapter;
    }

    /**
     * @param  array $factoryInterfaces
     * @return null|string
     * @throws \Exception
     */
    private function findAdapter(array $factoryInterfaces)
    {
        $this->validateFactoryInterfaces($factoryInterfaces);

        foreach ($this->Adapters as $Adapter => $adapterInterfaces) {
            if (count(array_intersect($adapterInterfaces, $factoryInterfaces)) == count($factoryInterfaces)) {
                return $Adapter;
            }
        }

        foreach ($this->FallbackAdapters as $Adapter => $adapterInterfaces) {
            if (count(array_intersect($adapterInterfaces, $factoryInterfaces)) == count($factoryInterfaces)) {
                return $Adapter;
            }
        }

        throw new \Exception('No suitable Adapter found for ' . implode(', ', $factoryInterfaces));
    }

    /**
     * @param array $factoryInterfaces
     * @throws \Exception
     */
    private function validateFactoryInterfaces(array $factoryInterfaces)
    {
        foreach ($factoryInterfaces as $factoryInterface) {
            if (!$this->isFactoryInterface($factoryInterface)) {
                throw new \Exception($factoryInterface . ' is not a Factory Interface');
            }
        }
    }

    /**
     * @param string $Interface
     * @return bool
     */
    private function isFactoryInterface(string $Interface)
    {
        $Reflection = new \ReflectionClass($Interface);
        return $Reflection->implementsInterface(FactoryInterface::class);
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
