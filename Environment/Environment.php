<?php

namespace PRECAST\Environment;


use PRECAST\Vendor\Factory;
use PRECAST\Vendor\Factory\Adapter\File\Contract\YamlFileInterface;
use PRECAST\Vendor\Factory\AdapterInterface;
use PRECAST\Vendor\Factory\Contract\FileInterface;

class Environment
{

    /**
     * Environment constructor.
     */
    public function __construct()
    {
        $Factory = new Factory();

        /** @var YamlFileInterface|FileInterface $Adapter */
        $Adapter = $Factory->createAdapter(
            YamlFileInterface::class
        );

        $Adapter->setFileLocation( 'Environment.yaml' );

        var_dump( $Adapter );
    }

    public static function configureAdapter(AdapterInterface $Adapter)
    {

    }
}
