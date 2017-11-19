<?php

namespace PRECAST\Vendor\Factory;

/**
 * Class AbstractFactory
 * @package Vendor\Factory
 */
abstract class AbstractPackage implements PackageInterface
{
    /** @var AdapterInterface[][] $AdapterList */
    private static $AdapterList = [];
    private $AdapterNamespace = 'PRECAST\Vendor\Factory\Adapter';
    /** @var null|AdapterInterface $Adapter */

    private $Adapter = null;
    /** @var string $Interface */
    private $Interface = '';

    /**
     * PackageInterface constructor.
     */
    protected function __construct()
    {
        if (!$this->Adapter) {
            $this->findAdapter();
            $Adapter = current(self::$AdapterList[$this->Interface]);
            if (!$Adapter) {
                throw new \Exception('No Adapter available for ' . $this->Interface);
            }
            $this->useAdapter(new $Adapter);
        }
    }

    /**
     * @return PackageInterface
     */
    private function findAdapter()
    {
        if( !isset(self::$AdapterList[$this->Interface]) ) {
            $AdapterFileList = array_map(function ($Adapter) {
                return $this->AdapterNamespace . '\\' . basename($Adapter, '.php');
            }, array_slice(scandir(str_replace('PRECAST\\', '', $this->AdapterNamespace)), 2));

            self::$AdapterList[$this->Interface] = array_filter($AdapterFileList, function ($Class) {
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
    public function getAdapter()
    {
        return $this->Adapter;
    }
}
