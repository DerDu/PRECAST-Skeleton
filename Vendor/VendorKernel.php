<?php

namespace Vendor;

use Vendor\Adapter\SymfonyFinder;
use Vendor\Factory\FileSystem;

/**
 * Class VendorKernel
 * @package Vendor
 */
class VendorKernel
{
    public static function useFileSystem()
    {
        $Factory = new FileSystem();

        $Factory->useAdapter( new SymfonyFinder() );

        $Factory->setupContainer();

        return $Factory->getContainer();
    }
}
