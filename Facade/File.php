<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Factory\Contract\FileInterface;

/**
 * Class File
 * @package PRECAST\Facade
 */
class File implements FacadeInterface
{
    /**
     * @return null|FileInterface
     */
    public static function Package(): FileInterface
    {
        return (new \PRECAST\Vendor\Factory\Package\File())->getPackage();
    }
}
