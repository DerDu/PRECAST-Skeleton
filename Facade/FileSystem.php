<?php

namespace PRECAST\Facade;

use PRECAST\Facade\Contract\AbstractFacade;
use PRECAST\Facade\Contract\FacadeOption;
use PRECAST\Vendor\Factory\Contract\FileSystemInterface;

/**
 * Class Cache
 * @package PRECAST\Facade
 */
class FileSystem extends AbstractFacade
{
    /**
     * @param FacadeOption|null $FacadeOption
     * @return FileSystemInterface
     */
    public static function Package(FacadeOption $FacadeOption = null): FileSystemInterface
    {
        return (new \PRECAST\Vendor\Factory\Package\FileSystem())->getPackage();
    }
}

