<?php

namespace PRECAST\Vendor\Factory;

use PRECAST\Benchmark;
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
        switch (Environment::getEnvironment()) {
            case Environment::USE_PRODUCTION:
            case Environment::USE_INTEGRATION:
            case Environment::USE_TEST:
                if (!isset(self::$AdapterList[$this->Interface])) {
                    $AdapterCache = $Cache->getValue($this->Interface, __METHOD__);
                    if (null !== $AdapterCache) {
                        Benchmark::Log(__METHOD__.' CACHE '.PHP_EOL.$this->Interface);
                        self::$AdapterList[$this->Interface] = $AdapterCache;
                    }
                }
                break;
        }

        // Ask FileSystem
        if (!isset(self::$AdapterList[$this->Interface])) {
            Benchmark::Log(__METHOD__.' I/O '.PHP_EOL.$this->Interface);

            $Directory = trim(str_replace('PRECAST', '', $this->AdapterNamespace), '\\');
            $RDI = new \RecursiveDirectoryIterator($Directory, \RecursiveDirectoryIterator::SKIP_DOTS);
            $RII = new \RecursiveIteratorIterator(
                $RDI, \RecursiveIteratorIterator::SELF_FIRST, \RecursiveIteratorIterator::CATCH_GET_CHILD
            );
            $AdapterClassList = [];
            /** @var \SplFileInfo $Item */
            foreach ($RII as $Item) {
                if ($Item->isDir()) {
                    continue;
                }
                $AdapterClassList[] = 'PRECAST\\' . $Item->getPath() . '\\' . $Item->getBasename('.php');
            }

            self::$AdapterList[$this->Interface] = array_filter($AdapterClassList, function ($Class) {
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
//        if (Environment::getEnvironment() == Environment::USE_TEST) {
//            $this->Interface = $AdapterInterface . 'MockUp';
//        } else {
            $this->Interface = $AdapterInterface;
//        }
        return $this;
    }
}
