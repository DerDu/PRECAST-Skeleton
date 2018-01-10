<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Factory;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;
use PRECAST\Vendor\Factory\Adapter\File\Contract\BladeFileInterface;
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
    const TYPE_AUTO = 0;

    const TYPE_YAML = 1;
    const TYPE_TWIG = 2;
    const TYPE_TPL = 3;
    const TYPE_BLADE = 4;


    /**
     * @param string $FileLocation
     * @param int $Type
     * @return AdapterInterface
     */
    public static function createInstance(string $FileLocation, int $Type = File::TYPE_AUTO)
    {
        $Factory = new Factory();
        /** @var null|RootFileInterface|AdapterInterface $Adapter */
        $Adapter = null;

        // Detect File Type
        if ($Type == File::TYPE_AUTO) {
            $fileExtension = strtolower(
                pathinfo($FileLocation, PATHINFO_EXTENSION)
            );
            switch ($fileExtension) {
                case 'yaml':
                    $Type = File::TYPE_YAML;
                    break;
                case 'twig':
                    $Type = File::TYPE_TWIG;
                    break;
                case 'tpl':
                    $Type = File::TYPE_TPL;
                    break;
                case 'blade':
                case 'blade.php':
                    $Type = File::TYPE_BLADE;
                    break;
                default:
                    $Type = File::TYPE_AUTO;
            }
        }

        // Create Adapter
        switch ($Type) {
            case File::TYPE_YAML:
                $Adapter = $Factory->createAdapter(
                    RootFileInterface::class, YamlFileInterface::class
                );
                break;
            case File::TYPE_TWIG:
                $Adapter = $Factory->createAdapter(
                    RootFileInterface::class, TwigFileInterface::class
                );
                break;
            case File::TYPE_TPL:
                $Adapter = $Factory->createAdapter(
                    RootFileInterface::class, TplFileInterface::class
                );
                break;
            case File::TYPE_BLADE:
                $Adapter = $Factory->createAdapter(
                    RootFileInterface::class, BladeFileInterface::class
                );
                break;
            default:
                $Adapter = $Factory->createAdapter(
                    RootFileInterface::class, RootFallbackInterface::class
                );
        }

        $Adapter->setFileLocation($FileLocation);

        return $Adapter;
    }
}
