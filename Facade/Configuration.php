<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Factory\Contract\ConfigurationInterface;

/**
 * Class Configuration
 * @package PRECAST\Facade
 */
class Configuration implements FacadeInterface
{
    /**
     * @return null|ConfigurationInterface
     */
    public static function Package(): ConfigurationInterface
    {
        return (new \PRECAST\Vendor\Factory\Package\Configuration())->getPackage();
    }
}
