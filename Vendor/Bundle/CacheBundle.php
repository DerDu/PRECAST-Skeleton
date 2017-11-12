<?php
namespace Vendor\Bundle;

use Vendor\AbstractBundle;
use Vendor\AdapterInterface;
use Vendor\Factory\CacheFactory;

/**
 * Class CacheBundle
 * @package Vendor\Bundle
 */
class CacheBundle extends AbstractBundle
{
    const CACHE_TYPE_FILE = 'files';

    /**
     * CacheBundle constructor.
     * @param SettingBundle $SettingBundle
     * @param string $Connection
     * @throws \Exception
     */
    public function __construct(SettingBundle $SettingBundle, $Connection = 'Memory')
    {
        print __METHOD__ . PHP_EOL;
        /** @var SettingInterface $Adapter */
        $Adapter = $SettingBundle->getAdapter();
        $Setting = $Adapter->getValue( $Connection );
        if( isset( $Setting['Adapter'] ) ) {
            $Class = 'Vendor\Adapter\\'.$Setting['Adapter'].'Adapter';
            /** @var AdapterInterface $Adapter */
            $Adapter = new $Class();
            $this->setAdapter( (new CacheFactory( $Adapter ))->getAdapter() );
        } else {
            throw new \Exception('Connection ('.$Connection.') not found!');
        }
    }
}
