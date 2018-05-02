<?php

namespace PRECAST\Environment;


use PRECAST\Benchmark;
use PRECAST\Environment\Exception\EnvironmentException;
use PRECAST\Facade\Cache;
use PRECAST\Facade\File;
use PRECAST\Vendor\Exception\AdapterException;
use PRECAST\Vendor\Exception\FactoryException;
use PRECAST\Vendor\Factory\Adapter\File\Contract\YamlFileInterface;
use PRECAST\Vendor\Factory\Adapter\File\YamlFile;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class Environment
 * @package PRECAST\Environment
 */
class Environment
{
    /** @var array $Configuration */
    private static $Configuration = [];
    /** @var array $Mapping */
    private static $Mapping = [];
    /** @var bool $hasEnvironment */
    public static $hasEnvironment = false;

    /**
     * @return bool
     */
    public function hasEnvironment(): bool
    {
        return self::$hasEnvironment;
    }

    /**
     * @param bool $hasEnvironment
     * @return Environment
     */
    public function setHasEnvironment(bool $hasEnvironment): Environment
    {
        self::$hasEnvironment = $hasEnvironment;
        return $this;
    }

    /**
     * Environment constructor.
     * @param string $useEnvironment
     * @throws EnvironmentException
     * @throws AdapterException
     * @throws FactoryException
     * @throws \Exception
     */
    public function __construct(string $useEnvironment = __DIR__ . DIRECTORY_SEPARATOR . 'Environment.yaml')
    {

        $EnvironmentHostName = gethostname();
        $EnvironmentHostIp = gethostbynamel($EnvironmentHostName);
        Benchmark::Log('Host-Name: ' . $EnvironmentHostName . ', Address-List: ' . implode(', ', $EnvironmentHostIp));

        $Cache = Cache::createInstance(Cache::TYPE_FILES);
        $Key = $EnvironmentHostName . '_' . implode($EnvironmentHostIp);

        $Configuration = $Cache->get($Key, []);

        if (empty($Configuration)) {
            /** @var YamlFile $Adapter */
            $Adapter = File::createInstance($useEnvironment);
            if (!$Adapter instanceof YamlFileInterface) {
                throw new EnvironmentException('Environment ' . $useEnvironment . ' not supported');
            }

            $Adapter->readFile();
            $Adapter->writeFile();

            $Environments = $Adapter->getFileContent();

            foreach ($Environments as $Environment => $Setup) {

                if (isset($Setup['Host'])) {
                    $Hosts = (array)$Setup['Host'];
                } else {
                    $Hosts = [];
                }

                if (!empty(array_intersect($EnvironmentHostIp, $Hosts))) {

                    $this->setHasEnvironment(true);
                    Benchmark::Log('Environment: ' . $Environment);

                    $Locations = (array)$Setup['Location'];
                    foreach ($Locations as $Location) {
                        /** @var YamlFile $Adapter */
                        $Adapter = File::createInstance($Location);
                        if (!$Adapter instanceof YamlFileInterface) {
                            throw new EnvironmentException('Environment ' . $Location . ' not supported');
                        }

                        $Adapter->readFile();
                        $Adapter->writeFile();

                        self::$Configuration = array_merge(self::$Configuration, $Adapter->getFileContent());
                    }
                }
            }

            $Cache->set($Key, self::$Configuration, 30);
        } else {
            $this->setHasEnvironment(true);
            self::$Configuration = $Configuration;
        }

        if (!$this->hasEnvironment()) {
            throw new EnvironmentException(
                'No Environment for ' . $EnvironmentHostName . ' [' . implode(', ', $EnvironmentHostIp) . ']'
            );
        }
    }

    /**
     * @param string $FactoryInterface
     * @param string $ConfigurationGroup
     */
    public static function configureMapping(string $FactoryInterface, string $ConfigurationGroup)
    {
        self::$Mapping[$FactoryInterface] = $ConfigurationGroup;
    }

    /**
     * @param AdapterInterface $Adapter
     * @return AdapterInterface
     */
    public static function configureAdapter(AdapterInterface $Adapter)
    {
        return $Adapter;
    }

    /**
     * @return array
     */
    public function getConfiguration(): array
    {
        return self::$Configuration;
    }
}
