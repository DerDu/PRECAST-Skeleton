<?php

namespace PRECAST\Environment;


use PRECAST\Benchmark;
use PRECAST\Facade\Cache;
use PRECAST\Facade\File;
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
    private $hasEnvironment = false;

    /**
     * @return bool
     */
    private function isHasEnvironment(): bool
    {
        return $this->hasEnvironment;
    }

    /**
     * @param bool $hasEnvironment
     * @return Environment
     */
    private function setHasEnvironment(bool $hasEnvironment): Environment
    {
        $this->hasEnvironment = $hasEnvironment;
        return $this;
    }

    /**
     * Environment constructor.
     * @param string $useEnvironment
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
                throw new \Exception('Environment ' . $useEnvironment . ' not supported');
            }

            $Adapter->readFile();
            $Adapter->writeFile();

            $Environments = $Adapter->getFileContent();

            foreach ($Environments as $Environment => $Setup) {

                $Hosts = (array)$Setup['Host'];
                if (!empty(array_intersect($EnvironmentHostIp, $Hosts))) {

                    $this->setHasEnvironment(true);
                    Benchmark::Log('Environment: ' . $Environment);

                    $Locations = (array)$Setup['Location'];
                    foreach ($Locations as $Location) {
                        /** @var YamlFile $Adapter */
                        $Adapter = File::createInstance($Location);
                        if (!$Adapter instanceof YamlFileInterface) {
                            throw new \Exception('Environment ' . $Location . ' not supported');
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

        if (!$this->isHasEnvironment()) {
            throw new \Exception(
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
