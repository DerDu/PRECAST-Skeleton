<?php

namespace PRECAST\Vendor;

use PRECAST\Vendor\Factory\AdapterInterface;
use PRECAST\Vendor\Factory\FactoryInterface;
use PRECAST\Vendor\Factory\FallbackAdapterInterface;

/**
 * Class Factory
 * @package PRECAST\Vendor
 */
class Factory
{
    /** @var string $AdapterDirectory */
    private $AdapterDirectory = 'Vendor/Factory/Adapter';
    /** @var array $FallbackAdapters */
    private $FallbackAdapters = [];
    /** @var array $Adapters */
    private $Adapters = [];

    /**
     * Factory constructor.
     */
    public function __construct()
    {
        $this->loadAvailableAdapter();
    }

    /**
     *
     */
    private function loadAvailableAdapter()
    {
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

                if ($Reflection->implementsInterface(FallbackAdapterInterface::class)) {
                    $this->FallbackAdapters[$Class] = $Reflection->getInterfaceNames();
                } else {
                    if ($Reflection->implementsInterface(AdapterInterface::class)) {
                        $this->Adapters[$Class] = $Reflection->getInterfaceNames();
                    }
                }
            }
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

        throw new \Exception('No suitable Adapter found for '. implode(', ', $factoryInterfaces));
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
}
