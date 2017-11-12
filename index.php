<?php

use Configuration\Environment;
use Vendor\Adapter\DoctrineAdapter;
use Vendor\Adapter\YamlAdapter;
use Vendor\Bundle\CacheBundle;
use Vendor\Bundle\DatabaseBundle;
use Vendor\Bundle\SettingBundle;
use Vendor\Bundle\TemplateBundle;
use Vendor\Factory\DatabaseFactory;
use Vendor\Factory\TemplateFactory;

require_once __DIR__ . DIRECTORY_SEPARATOR
    . 'Vendor' . DIRECTORY_SEPARATOR
    . 'Repository' . DIRECTORY_SEPARATOR
    . 'autoload.php';

\Vendor\AbstractFactory::setUseMockUp(false);

$File = __DIR__.'/Template/Test.twig';
$Template = (new TemplateBundle( $File ));
/** @var \Vendor\Adapter\TwigAdapter $Adapter */
$Adapter = $Template->getAdapter();
var_dump( $Adapter->renderTemplate() );

print PHP_EOL;

$File = 'Database.yml';
$Database = (new DatabaseBundle( Environment::getSettingBundle( $File ), 'NamePlaceHolder' ));
/** @var \Vendor\Adapter\DoctrineAdapter $Adapter */
$Adapter = $Database->getAdapter();
var_dump( $Adapter->connectDatabase() );

print PHP_EOL;

$File = 'Cache.yml';
$Database = (new CacheBundle( Environment::getSettingBundle( $File ), 'NamePlaceHolder' ));
/** @var \Vendor\Adapter\PhpFastCacheAdapter $Adapter */
$Adapter = $Database->getAdapter();
var_dump( $Adapter->setValue( 'TestKey', 'TestValue', 'TestRegion' ) );
var_dump( $Adapter->getValue( 'TestKey', 'TestRegion' ) );

///** @var YamlAdapter $Adapter */
//var_dump( $Adapter = (new SettingBundle( $File ))->getAdapter() );
//
//var_dump( $Adapter->getValue( 'Memory', 'Adapter' ) );

//var_dump( $Adapter->setValue( 'Eloquent','Memory', 'Adapter' ) );
//$Adapter->saveFile( $File );
