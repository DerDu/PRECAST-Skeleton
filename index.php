<?php

use Configuration\Environment;
use Vendor\Adapter\DoctrineAdapter;
use Vendor\Adapter\YamlAdapter;
use Vendor\Bundle\DatabaseBundle;
use Vendor\Bundle\SettingBundle;
use Vendor\Bundle\TemplateBundle;
use Vendor\Factory\DatabaseFactory;
use Vendor\Factory\TemplateFactory;

require_once __DIR__ . DIRECTORY_SEPARATOR
    . 'Vendor' . DIRECTORY_SEPARATOR
    . 'Repository' . DIRECTORY_SEPARATOR
    . 'autoload.php';

//var_dump((new DatabaseFactory(new DoctrineAdapter()))->getAdapter());
//var_dump((new TemplateFactory(new YamlAdapter()))->getAdapter());

\Vendor\AbstractFactory::setUseMockUp(true);

$File = 'Template/Test.twig';
$Template = (new TemplateBundle( $File ));

print PHP_EOL;

$File = 'Database.yml';
$Database = (new DatabaseBundle( Environment::getSettingBundle( $File ), 'NamePlaceHolder' ));
var_dump( $Database );
///** @var YamlAdapter $Adapter */
//var_dump( $Adapter = (new SettingBundle( $File ))->getAdapter() );
//
//var_dump( $Adapter->getValue( 'Memory', 'Adapter' ) );

//var_dump( $Adapter->setValue( 'Eloquent','Memory', 'Adapter' ) );
//$Adapter->saveFile( $File );
