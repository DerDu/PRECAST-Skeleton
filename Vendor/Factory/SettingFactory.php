<?php

namespace Vendor\Factory;

use Vendor\AbstractFactory;
use Vendor\AdapterInterface;
use Vendor\Bundle\SettingInterface;
use Vendor\FactoryInterface;

/**
 * Class SettingFactory
 * @package Vendor\Factory
 */
class SettingFactory extends AbstractFactory implements FactoryInterface
{
    /**
     * SettingFactory constructor.
     * @param AdapterInterface $Adapter
     * @throws \Exception
     */
    public function __construct(AdapterInterface $Adapter)
    {
        print __METHOD__ . PHP_EOL;
        if ($Adapter instanceof SettingInterface) {
            parent::__construct($Adapter);
        } else {
            throw new \Exception('Adapter must implement SettingInterface');
        }
    }
}
