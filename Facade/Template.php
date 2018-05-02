<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Exception\AdapterException;
use PRECAST\Vendor\Exception\FactoryException;
use PRECAST\Vendor\Factory;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;
use PRECAST\Vendor\Factory\Adapter\File\Contract\BladeFileInterface;
use PRECAST\Vendor\Factory\Adapter\File\Contract\TplFileInterface;
use PRECAST\Vendor\Factory\Adapter\File\Contract\TwigFileInterface;
use PRECAST\Vendor\Factory\Adapter\Template\Contract\RootTemplateInterface;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class Template
 * @package PRECAST\Facade
 */
class Template
{

    const TYPE_AUTO = 0;

    const TYPE_TWIG = 1;
    const TYPE_SMARTY = 2;
    const TYPE_BLADE = 3;

    /**
     * @param string $FileLocation
     * @param int $Type
     * @return AdapterInterface
     * @throws AdapterException
     * @throws FactoryException
     */
    public static function createInstance(string $FileLocation, int $Type = Template::TYPE_AUTO)
    {
        $Factory = new Factory();
        /** @var null|RootTemplateInterface|AdapterInterface $Adapter */
        $Adapter = null;

        // Detect File Type
        if ($Type == Template::TYPE_AUTO) {
            $fileExtension = strtolower(
                pathinfo($FileLocation, PATHINFO_EXTENSION)
            );
            switch ($fileExtension) {
                case 'twig':
                    $Type = Template::TYPE_TWIG;
                    break;
                case 'tpl':
                    $Type = Template::TYPE_SMARTY;
                    break;
                case 'blade':
                case 'blade.php':
                    $Type = Template::TYPE_BLADE;
                    break;
                default:
                    $Type = Template::TYPE_AUTO;
            }
        }

        // Create Adapter
        switch ($Type) {
            case Template::TYPE_TWIG:
                $Adapter = $Factory->createAdapter(
                    RootTemplateInterface::class, TwigFileInterface::class
                );
                break;
            case Template::TYPE_SMARTY:
                $Adapter = $Factory->createAdapter(
                    RootTemplateInterface::class, TplFileInterface::class
                );
                break;
            case Template::TYPE_BLADE:
                $Adapter = $Factory->createAdapter(
                    RootTemplateInterface::class, BladeFileInterface::class
                );
                break;
            default:
                $Adapter = $Factory->createAdapter(
                    RootTemplateInterface::class, RootFallbackInterface::class
                );
        }

        return $Adapter;
    }
}
