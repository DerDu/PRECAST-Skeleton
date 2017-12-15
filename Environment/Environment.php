<?php

namespace PRECAST\Environment;

use PRECAST\Facade\Contract\FacadeOption;
use PRECAST\Facade\File;
use PRECAST\Facade\FileSystem;
use PRECAST\Vendor\Factory\Contract\FileInterface;

/**
 * Class Environment
 * @package PRECAST\Environment
 */
class Environment
{

    const USE_TEST = __DIR__ . DIRECTORY_SEPARATOR . 'UnitTest';
    const USE_DEVELOPMENT = __DIR__ . DIRECTORY_SEPARATOR . 'Development';
    const USE_INTEGRATION = __DIR__ . DIRECTORY_SEPARATOR . 'Integration';
    const USE_PRODUCTION = __DIR__ . DIRECTORY_SEPARATOR . 'Production';

    /**
     * @param string $Environment
     */
    public static function setEnvironment($Environment = Environment::USE_PRODUCTION)
    {
        if (!defined('APP_ENVIRONMENT')) {
            define('APP_ENVIRONMENT', $Environment);
        }

        switch (self::getEnvironment()) {
            case self::USE_INTEGRATION:
            case self::USE_PRODUCTION:
                (new \PRECAST\Benchmark())->disableOutput();
                break;
            default:
                (new \PRECAST\Benchmark())->enableOutput();
                break;
        }
    }

    /**
     * @return string
     */
    public static function getEnvironment()
    {
        return APP_ENVIRONMENT;
    }

    /**
     * @param string $FileName
     * @return FileInterface
     */
    public static function getConfigurationFile($FileName)
    {
        $File = FileSystem::Package()
            ->searchDirectory(self::getEnvironment())
            ->findFile($FileName)
            ->getFile();

        return File::Package(
            (new FacadeOption())->setOption(File::OPTION_FILE_TYPE, pathinfo($File, PATHINFO_EXTENSION))
        )->loadFile($File);
    }
}
