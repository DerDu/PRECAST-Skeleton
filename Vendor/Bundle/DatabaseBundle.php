<?php

namespace Vendor\Bundle;

use Vendor\AbstractBundle;
use Vendor\AdapterInterface;
use Vendor\Factory\DatabaseFactory;

/**
 * Class DatabaseBundle
 * @package Vendor\Bundle
 */
class DatabaseBundle extends AbstractBundle
{

    /**
     * DatabaseBundle constructor.
     * @param SettingBundle $SettingBundle
     * @param string $Connection
     * @throws \Exception
     */
    public function __construct(SettingBundle $SettingBundle, $Connection = 'Memory')
    {
        print __METHOD__ . PHP_EOL;
        /** @var DatabaseInterface $Adapter */
        $Adapter = $SettingBundle->getAdapter();
        $Setting = $Adapter->getValue( $Connection );
        if( isset( $Setting['Adapter'] ) ) {
            $Class = 'Vendor\Adapter\\'.$Setting['Adapter'].'Adapter';
            /** @var AdapterInterface $Adapter */
            $Adapter = new $Class();
            $this->setAdapter( (new DatabaseFactory( $Adapter ))->getAdapter() );
        } else {
            throw new \Exception('Connection ('.$Connection.') not found!');
        }
    }

}
