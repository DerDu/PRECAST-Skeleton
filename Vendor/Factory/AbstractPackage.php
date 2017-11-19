<?php

namespace PRECAST\Vendor\Factory;

/**
 * Class AbstractFactory
 * @package Vendor\Factory
 */
abstract class AbstractPackage implements PackageInterface
{
    private $AdapterNamespace = 'PRECAST\Vendor\Factory\Adapter';
    /** @var null|AdapterInterface $Adapter */

    private $Adapter = null;
    /** @var AdapterInterface[] $AdapterList */
    private static $AdapterList = [];

    /** @var string $Interface */
    private $Interface = '';

    /**
     * PackageInterface constructor.
     */
    protected function __construct()
    {
        if (!$this->Adapter) {
            $this->findAdapter();
            $Adapter = current(self::$AdapterList);
            if(!$Adapter) {
                throw new \Exception('No Adapter available for '.$this->Interface);
            }
            $this->useAdapter(new $Adapter);
        }
    }

    /**
     * @return PackageInterface
     */
    private function findAdapter()
    {
        if( !self::$AdapterList ) {
            $AdapterFileList = array_map(function ($Adapter) {
                return $this->AdapterNamespace . '\\' . basename($Adapter, '.php');
            }, array_slice(scandir(str_replace('PRECAST\\', '', $this->AdapterNamespace)), 2));

            self::$AdapterList = array_filter($AdapterFileList, function ($Class) {
                return in_array($this->Interface, class_implements($Class));
            });
        }
        return $this;
    }

    /**
     * @param string $AdapterInterface
     * @return PackageInterface
     */
    protected function defineInterface(string $AdapterInterface)
    {
        $this->Interface = $AdapterInterface;
        return $this;
    }

    /**
     * @param AdapterInterface $Adapter
     * @return PackageInterface
     */
    protected function useAdapter(AdapterInterface $Adapter): PackageInterface
    {
        $this->Adapter = $Adapter;
        return $this;
    }

    /**
     * @return null|AdapterInterface
     */
    protected function getAdapter()
    {
        return $this->Adapter;
    }
}
