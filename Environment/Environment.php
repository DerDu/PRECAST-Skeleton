<?php

namespace PRECAST\Environment;

/**
 * Class Environment
 */
class Environment
{
    /**
     * PHPUnit
     */
    const USE_TEST = __DIR__ . DIRECTORY_SEPARATOR . 'Test';
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
    }

    /**
     * @param string $FileName
     * @return string
     */
    public static function getConfigurationFile($FileName)
    {
        return APP_ENVIRONMENT . DIRECTORY_SEPARATOR . $FileName;
    }

    /**
     * @return string
     */
    public static function getEnvironment()
    {
        return APP_ENVIRONMENT;
    }
}
