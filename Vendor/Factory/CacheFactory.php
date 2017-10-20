<?php

namespace Vendor\Factory;

use Vendor\AbstractFactory;
use Vendor\AdapterInterface;
use Vendor\FactoryInterface;

/**
 * Class CacheFactory
 * @package Vendor\Factory
 */
class CacheFactory extends AbstractFactory implements FactoryInterface
{
    /**
     * TemplateFactory constructor.
     * @param AdapterInterface $Adapter
     */
    public function __construct(AdapterInterface $Adapter)
    {
        print __METHOD__ . PHP_EOL;
        parent::__construct($Adapter);
    }
}
