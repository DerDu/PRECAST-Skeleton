<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Factory;
use PRECAST\Vendor\Factory\Adapter\File\Contract\TwigFileInterface;
use PRECAST\Vendor\Factory\Contract\TemplateInterface;
use PRECAST\Vendor\Factory\FallbackAdapterInterface;

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
                    TemplateInterface::class,
                    TwigFileInterface::class
                );
            case 'tpl':
                return $Factory->createAdapter(
                    TemplateInterface::class
                );
            default:
                return $Factory->createAdapter(
                    TemplateInterface::class,
                    FallbackAdapterInterface::class
                );
        }
    }
}
