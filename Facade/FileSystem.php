<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Factory\Contract\FileSystemInterface;

/**
 * Class Cache
 * @package PRECAST\Facade
 */
class FileSystem
{
    /**
     * @return null|FileSystemInterface
     */
    public static function Package(): FileSystemInterface
    {
        return (new \PRECAST\Vendor\Factory\Package\FileSystem())->getPackage();
    }
}

