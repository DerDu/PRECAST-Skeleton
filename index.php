<?php
declare(strict_types=1);

use PRECAST\Benchmark;
use PRECAST\Facade\Cache;
use PRECAST\Facade\Template;
use PRECAST\Vendor\Factory;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\FileCacheInterface;
use PRECAST\Vendor\Factory\Adapter\File\Contract\TwigFileInterface;
use PRECAST\Vendor\Factory\Contract\CacheInterface;
use PRECAST\Vendor\Factory\Contract\FileInterface;
use PRECAST\Vendor\Factory\Contract\TemplateInterface;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Benchmark.php';
$WallTime = new Benchmark();
$Benchmark = new Benchmark();

// #####################################################################################################################

require_once __DIR__ . DIRECTORY_SEPARATOR
    . 'Vendor' . DIRECTORY_SEPARATOR
    . 'Repository' . DIRECTORY_SEPARATOR
    . 'autoload.php';

$Benchmark->printBenchmark('Boot Autoloader');

// #####################################################################################################################

$Whoops = new \Whoops\Run;
$Whoops->pushHandler(new \Whoops\Handler\PlainTextHandler());
$Whoops->register();

$Factory = new Factory();

$Benchmark->printBenchmark('Bootstrap');

//// #####################################################################################################################
//$Benchmark = new Benchmark();
//
////$Factory = new Factory(new Factory\Adapter\Cache\FileCache());
//$Factory = new Factory();
//
//$Benchmark->printBenchmark('Boot Factory');
////$Benchmark->disableOutput();
////var_dump($Factory);
////$Benchmark->enableOutput();
//
//// #####################################################################################################################
//
///** @var CacheInterface $Adapter */
//$Adapter = $Factory->createAdapter(
//    CacheInterface::class,
//    FileCacheInterface::class
//);
//
//$Benchmark->printBenchmark('Cache Adapter');
////var_dump($Adapter);
//
//// #####################################################################################################################
//
///** @var FileInterface $Adapter */
//$Adapter = $Factory->createAdapter(
//    FileInterface::class
//);
//$Adapter->setFileLocation(__DIR__ . DIRECTORY_SEPARATOR . '.gitignore');
//
//$Benchmark->printBenchmark('File Adapter');
////var_dump($Adapter);
//
//// #####################################################################################################################
//$Benchmark->enableOutput();
//
///** @var TemplateInterface $Adapter */
//$Adapter = $Factory->createAdapter(
//    TemplateInterface::class
//    , TwigFileInterface::class
//);
//
//$Benchmark->printBenchmark('Template Adapter');
//var_dump($Adapter);
//
//// #####################################################################################################################
//
//$Benchmark->printBenchmark('Finished');

// #####################################################################################################################
// FACADE TEST
// #####################################################################################################################
//$Benchmark = new Benchmark();
//$Benchmark->disableOutput();

$Adapter = Template::createInstance( 'Test.twig' );
//$Benchmark->printBenchmark(get_class( $Adapter ).' Facade');

$Adapter = Template::createInstance( 'Test.tpl' );
//$Benchmark->printBenchmark(get_class( $Adapter ).' Facade');

$Adapter = Template::createInstance( 'Test.something' );
//$Benchmark->printBenchmark(get_class( $Adapter ).' Facade');



/** @var CacheInterface $Adapter */
$Adapter = Cache::createInstance( Cache::TYPE_MEMORY );
//$Benchmark->printBenchmark(get_class( $Adapter ).' Facade');
//$Adapter->set('Test1', 'Value1', 10);
//var_dump($Adapter->get('Test1'));

$Adapter = Cache::createInstance( Cache::TYPE_FILES );
//$Benchmark->printBenchmark(get_class( $Adapter ).' Facade');
//$Adapter->set('Test2', 'Value2', 10);
//var_dump($Adapter->get('Test2'));

$Adapter = Cache::createInstance( Cache::TYPE_MEMCACHED );
//$Benchmark->printBenchmark(get_class( $Adapter ).' Facade');
//$Adapter->set('Test3', 'Value3', 10);
//var_dump($Adapter->get('Test3'));

// #####################################################################################################################
// EXIT
// #####################################################################################################################
//$WallTime->enableOutput();
$WallTime->printBenchmark('Exit');
