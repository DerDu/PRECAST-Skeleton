<?php

namespace PRECAST\Facade;

use PRECAST\Facade\Contract\AbstractFacade;
use PRECAST\Facade\Contract\FacadeOption;
use PRECAST\Vendor\Factory\Adapter\FileType\TwigFileType;
use PRECAST\Vendor\Factory\Adapter\FileType\YamlFileType;
use PRECAST\Vendor\Factory\Contract\FileInterface;

/**
 * Class File
 * @package PRECAST\Facade
 */
class File extends AbstractFacade
{
    const OPTION_FILE_TYPE = 0;

    /**
     * @param FacadeOption|null $FacadeOption
     * @return FileInterface
     */
    public static function Package(FacadeOption $FacadeOption = null): FileInterface
    {
        switch ($FacadeOption->getOption(self::OPTION_FILE_TYPE)) {
            case 'yaml':
                $Adapter = new YamlFileType();
                break;
            case 'twig':
                $Adapter = new TwigFileType();
                break;
            default:
                $Adapter = null;
                break;
        }

        return (new \PRECAST\Vendor\Factory\Package\File($Adapter))->getPackage();
    }
}
