<?php

namespace Vendor\Factory;

use Vendor\AbstractFactory;
use Vendor\AdapterInterface;
use Vendor\Factory\MockUpAdapter\DatabaseAdapter;
use Vendor\FactoryInterface;

/**
 * Class DatabaseFactory
 * @package Vendor\Factory
 */
class DatabaseFactory extends AbstractFactory implements FactoryInterface
{
    /**
     * DatabaseFactory constructor.
     * @param AdapterInterface $Adapter
     */
    public function __construct(AdapterInterface $Adapter)
    {
        print __METHOD__ . PHP_EOL;
        if( self::isUseMockUp() ) {
            $Adapter = new DatabaseAdapter();
        }
        parent::__construct($Adapter);
    }
}
