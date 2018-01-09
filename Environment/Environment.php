<?php

namespace PRECAST\Environment;


use PRECAST\Benchmark;
use PRECAST\Facade\File;
use PRECAST\Vendor\Factory\Adapter\File\Contract\YamlFileInterface;
use PRECAST\Vendor\Factory\Adapter\File\YamlFile;
use PRECAST\Vendor\Factory\AdapterInterface;
use PRECAST\Vendor\Factory\FactoryInterface;

class Environment
{
    /** @var array $Configuration */
    private static $Configuration = [];
    /** @var array $Mapping */
    private static $Mapping = [];

    /**
     * Environment constructor.
     * @param string $useEnvironment
     * @throws \Exception
     */
    public function __construct(string $useEnvironment = __DIR__ . DIRECTORY_SEPARATOR . 'Environment.yaml')
    {

        /** @var YamlFile $Adapter */
        $Adapter = File::createInstance($useEnvironment);
        if (!$Adapter instanceof YamlFileInterface) {
            throw new \Exception('Environment ' . $useEnvironment . ' not supported');
        }

        $Adapter->readFile();
        $Adapter->writeFile();

        $EnvironmentHostName = gethostname();
        $EnvironmentHostIp = gethostbynamel($EnvironmentHostName);

        $Environments = $Adapter->getFileContent();

        foreach ($Environments as $Environment => $Setup) {

            $Hosts = (array)$Setup['Host'];
            if (!empty(array_intersect($EnvironmentHostIp, $Hosts))) {

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
