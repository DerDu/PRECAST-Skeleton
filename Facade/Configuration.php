<?php

namespace PRECAST\Facade;

use PRECAST\Facade\Contract\AbstractFacade;
use PRECAST\Facade\Contract\FacadeOption;
use PRECAST\Vendor\Factory\Contract\ConfigurationInterface;

/**
 * Class Configuration
 * @package PRECAST\Facade
 */
class Configuration extends AbstractFacade
{
    /**
     * @param FacadeOption|null $FacadeOption
     * @return ConfigurationInterface
     */
    public static function Package(FacadeOption $FacadeOption = null): ConfigurationInterface
    {
        return (new \PRECAST\Vendor\Factory\Package\Configuration())->getPackage();
    }
}
