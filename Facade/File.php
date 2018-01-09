<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Factory;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;
use PRECAST\Vendor\Factory\Adapter\File\Contract\RootFileInterface;
use PRECAST\Vendor\Factory\Adapter\File\Contract\TplFileInterface;
use PRECAST\Vendor\Factory\Adapter\File\Contract\TwigFileInterface;
use PRECAST\Vendor\Factory\Adapter\File\Contract\YamlFileInterface;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class File
 * @package PRECAST\Facade
 */
class File
{
    /**
     * @param string $FileLocation
     * @return AdapterInterface
     */
    public static function createInstance(string $FileLocation)
    {
        $Factory = new Factory();
        /** @var null|RootFileInterface|AdapterInterface $Adapter */
        $Adapter = null;
        switch (strtolower( pathinfo($FileLocation, PATHINFO_EXTENSION) )) {
            case 'yaml':
                $Adapter = $Factory->createAdapter(
                    YamlFileInterface::class
                );
                break;
            case 'twig':
                $Adapter = $Factory->createAdapter(
                    TwigFileInterface::class
                );
                break;
            case 'tpl':
                $Adapter = $Factory->createAdapter(
                    TplFileInterface::class
                );
                break;
            default:
                $Adapter = $Factory->createAdapter(
                    RootFileInterface::class,
                    RootFallbackInterface::class
                );
                break;
        }

        $Adapter->setFileLocation($FileLocation);
        return $Adapter;
    }
}