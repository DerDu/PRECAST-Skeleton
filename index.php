<?php

use Vendor\Adapter\DoctrineAdapter;
use Vendor\Adapter\YamlAdapter;
use Vendor\Bundle\DatabaseBundle;
use Vendor\Bundle\SettingBundle;
use Vendor\Factory\DatabaseFactory;
use Vendor\Factory\TemplateFactory;

require_once __DIR__ . DIRECTORY_SEPARATOR
    . 'Vendor' . DIRECTORY_SEPARATOR
    . 'Repository' . DIRECTORY_SEPARATOR
    . 'autoload.php';

//var_dump((new DatabaseFactory(new DoctrineAdapter()))->getAdapter());
//var_dump((new TemplateFactory(new YamlAdapter()))->getAdapter());

var_dump( (new DatabaseBundle( new SettingBundle( 'Setting/Database.yml' ), 'Memory' )) );

///** @var YamlAdapter $Adapter */
//var_dump( $Adapter = (new SettingBundle( 'Setting/Database.yml' ))->getAdapter() );
//
//var_dump( $Adapter->getValue( 'Memory', 'Adapter' ) );
