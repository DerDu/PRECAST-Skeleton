<?php

namespace Vendor\Bundle;

use Vendor\AbstractBundle;
use Vendor\Adapter\TwigAdapter;
use Vendor\Adapter\SmartyAdapter;
use Vendor\AdapterInterface;
use Vendor\Factory\TemplateFactory;
use Vendor\Helper\FileLocator;

/**
 * Class TemplateBundle
 * @package Vendor\Bundle
 */
class TemplateBundle extends AbstractBundle
{
    /**
     * TemplateBundle constructor.
     * @param string $FileLocation
     * @throws \Exception
     */
    public function __construct($FileLocation)
    {
        print __METHOD__ . PHP_EOL;
        /** @var TemplateInterface $Adapter */
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
                case 'twig':
                    return (new TemplateFactory(new TwigAdapter()))->getAdapter();
                    break;
                case 'tpl':
                    return (new TemplateFactory(new SmartyAdapter()))->getAdapter();
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
