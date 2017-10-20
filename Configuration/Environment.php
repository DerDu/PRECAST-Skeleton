<?php

namespace Configuration;

use Vendor\Bundle\SettingBundle;

/**
 * Class Environment
 * @package Configuration
 */
class Environment
{
    /** @var null|string $Environment */
    private static $Environment = null;

    /**
     * Select configuration based on environment
     *
     * @param $File
     * @return SettingBundle
     */
    public static function getSettingBundle($File)
    {
        print __METHOD__ . PHP_EOL;
        self::loadEnvironment();

        return (new SettingBundle(
            __DIR__ . DIRECTORY_SEPARATOR . self::$Environment . DIRECTORY_SEPARATOR . basename($File)
        ));
    }

    /**
     * Fetch the current environment
     */
    private static function loadEnvironment()
    {
        print __METHOD__ . PHP_EOL;
        $Setting = (new SettingBundle(__DIR__ . DIRECTORY_SEPARATOR . 'Environment.yml'))->getAdapter();
        self::$Environment = $Setting->getValue('Environment');
    }
}
