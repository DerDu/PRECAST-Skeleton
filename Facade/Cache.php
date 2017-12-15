<?php

namespace PRECAST\Facade;

use PRECAST\Facade\Contract\AbstractFacade;
use PRECAST\Facade\Contract\FacadeOption;
use PRECAST\Vendor\Factory\Adapter\PhpFastCache;
use PRECAST\Vendor\Factory\Contract\CacheInterface;

/**
 * Class Cache
 * @package PRECAST\Facade
 */
class Cache extends AbstractFacade
{
    /**
     * @param FacadeOption|null $FacadeOption
     * @return CacheInterface
     */
    public static function Package(FacadeOption $FacadeOption = null): CacheInterface
    {
        return (new \PRECAST\Vendor\Factory\Package\Cache(
//            new PhpFastCache()
        ))->getPackage();
    }
}
