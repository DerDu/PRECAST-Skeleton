<?php

namespace Vendor\Bundle;

use Vendor\AbstractBundle;
use Vendor\Adapter\YamlAdapter;
use Vendor\AdapterInterface;
use Vendor\Factory\SettingFactory;
use Vendor\Helper\FileLocator;

/**
 * Class SettingBundle
 * @package Vendor\Bundle
 */
class SettingBundle extends AbstractBundle
{
    /**
     * SettingBundle constructor.
     * @param string $FileLocation
     * @throws \Exception
     */
    public function __construct($FileLocation)
    {
        print __METHOD__ . PHP_EOL;
        /** @var SettingInterface $Adapter */
        $Adapter = $this->selectAdapter(new FileLocator($FileLocation));
        $Adapter->loadFile($FileLocation);
        $this->setAdapter( $Adapter );
    }

    /**
     * @param FileLocator $FileLocator
     * @return AdapterInterface
     * @throws \Exception
     */
    private function selectAdapter(FileLocator $FileLocator)
    {
        if (FileLocator::MIME_TYPE_TEXT_PLAIN === $FileLocator->getFileMimeType()) {
            switch ($FileLocator->getFileExtension()) {
                case 'yml':
                case 'yaml':
                    return (new SettingFactory(new YamlAdapter()))->getAdapter();
                    break;
                default:
                    throw new \Exception('File-Type (' . $FileLocator->getFileExtension() . ') not supported!');
                    break;
            }
        } else {
            throw new \Exception('Mime-Type (' . $FileLocator->getFileMimeType() . ') not supported!');
        }
    }
}
