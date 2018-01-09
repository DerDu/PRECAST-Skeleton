<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Factory;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;
use PRECAST\Vendor\Factory\Adapter\File\Contract\TwigFileInterface;
use PRECAST\Vendor\Factory\Adapter\Template\Contract\RootTemplateInterface;

/**
 * Class Template
 * @package PRECAST\Facade
 */
class Template
{
    /**
     * @param string $FileLocation
     * @return Factory\AdapterInterface
     */
    public static function createInstance(string $FileLocation)
    {
        $Factory = new Factory();
        switch (pathinfo($FileLocation, PATHINFO_EXTENSION)) {
            case 'twig':
                return $Factory->createAdapter(
                    RootTemplateInterface::class,
                    TwigFileInterface::class
                );
            case 'tpl':
                return $Factory->createAdapter(
                    RootTemplateInterface::class
                );
            default:
                return $Factory->createAdapter(
                    RootTemplateInterface::class,
                    RootFallbackInterface::class
                );
        }
    }
}
