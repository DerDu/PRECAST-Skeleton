<?php

namespace PRECAST\Vendor\Factory;

use PRECAST\Environment\Environment;
use PRECAST\Vendor\Factory\Adapter\PhpFastCache;

/**
 * Class AbstractFactory
 * @package Vendor\Factory
 */
abstract class AbstractPackage implements PackageInterface
{
    /** @var AdapterInterface[][] $AdapterList */
    private static $AdapterList = [];
    /** @var string $AdapterNamespace */
    private $AdapterNamespace = 'PRECAST\Vendor\Factory\Adapter';
    /** @var null|AdapterInterface $Adapter */
    private $Adapter = null;
    /** @var string $Interface */
    private $Interface = '';

    /**
     * PackageInterface constructor.
     * @param AdapterInterface|null $Adapter
     * @throws \Exception
     */
    protected function __construct(AdapterInterface $Adapter = null)
    {
        if (empty($this->Interface)) {
            throw new \Exception('No Interface defined!');
        }
        if ($Adapter !== null && in_array($this->Interface, class_implements($Adapter))) {
            $this->useAdapter($Adapter);
        }
        if (null === $this->Adapter) {
            $this->findAdapter();
            $Adapter = current(self::$AdapterList[$this->Interface]);
            if (!$Adapter) {
                throw new \Exception('No Adapter available for ' . $this->Interface);
            }
            $this->useAdapter(new $Adapter);
        }
    }

    /**
     * @param AdapterInterface $Adapter
     * @return PackageInterface
     */
    final protected function useAdapter(AdapterInterface $Adapter): PackageInterface
    {
        $this->Adapter = $Adapter;
        return $this;
    }

    /**
     * @return PackageInterface
     */
    private function findAdapter()
    {
        $Cache = new PhpFastCache();

        // Ask Cache
        if (!isset(self::$AdapterList[$this->Interface])) {
            $AdapterCache = $Cache->getValue($this->Interface, __METHOD__);
            if (null !== $AdapterCache) {
                self::$AdapterList[$this->Interface] = $AdapterCache;
            }
        }

        // Ask FileSystem
        if (!isset(self::$AdapterList[$this->Interface])) {
            $AdapterFileList = array_map(function ($Adapter) {
                return $this->AdapterNamespace . '\\' . basename($Adapter, '.php');
            }, array_slice(scandir(str_replace('PRECAST\\', '', $this->AdapterNamespace)), 2));

            self::$AdapterList[$this->Interface] = array_filter($AdapterFileList, function ($Class) {
                return in_array($this->Interface, class_implements($Class));
            });
            $Cache->setValue($this->Interface, self::$AdapterList[$this->Interface], 900, __METHOD__);
        }

        return $this;
    }

    /**
     * @return null|AdapterInterface
     */
    public function getAdapter()
    {
        return $this->Adapter;
    }

    /**
     * @param string $AdapterInterface
     * @return PackageInterface
     */
    final protected function defineInterface(string $AdapterInterface)
    {
        if (Environment::getEnvironment() == Environment::USE_TEST) {
            $this->Interface = $AdapterInterface . 'MockUp';
        } else {
            $this->Interface = $AdapterInterface;
        }
        return $this;
    }
}
