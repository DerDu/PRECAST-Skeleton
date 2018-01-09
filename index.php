<?php
declare(strict_types=1);

use PRECAST\Benchmark;
use PRECAST\Environment\Environment;
use PRECAST\Facade\Cache;
use PRECAST\Facade\Template;
use PRECAST\Vendor\Factory;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\RootCacheInterface;
use PRECAST\Vendor\Factory\Adapter\Template\Contract\RootTemplateInterface;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Benchmark.php';
$WallTime = new Benchmark();
$Benchmark = new Benchmark();

// #####################################################################################################################

require_once __DIR__ . DIRECTORY_SEPARATOR
    . 'Vendor' . DIRECTORY_SEPARATOR
    . 'Repository' . DIRECTORY_SEPARATOR
    . 'autoload.php';

$Benchmark->printBenchmark('Setup Autoloader');

// #####################################################################################################################

// Setup/WarmUp Error Handler
$Whoops = new \Whoops\Run;
$Whoops->pushHandler(new \Whoops\Handler\PlainTextHandler());
$Whoops->register();

// WarmUp Factory
$Factory = new Factory();

var_dump( $Factory->getAdapters() );
var_dump( $Factory->getFallbackAdapters() );

// WarmUp Environment
$Environment = new Environment();

var_dump( $Environment->getConfiguration() );

Environment::configureMapping( RootCacheInterface::class, 'Cache' );
Environment::configureMapping( RootTemplateInterface::class, 'Template' );


$Benchmark->printBenchmark('Setup Application');

// #####################################################################################################################
// FACADE TEST
// #####################################################################################################################
$FacadeBenchmark = new Benchmark();
$FacadeBenchmark->disableOutput();

$Adapter = Template::createInstance('Test.twig');
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = Template::createInstance('Test.tpl');
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = Template::createInstance('Test.something');
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

/** @var RootCacheInterface $Adapter */
$Adapter = Cache::createInstance(Cache::TYPE_MEMORY);
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');
//$Adapter->set('Test1', 'Value1', 100);
//var_dump($Adapter->get('Test1'));

$Adapter = Cache::createInstance(Cache::TYPE_FILES);
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');
//$Adapter->set('Test2', 'Value2', 100);
//var_dump($Adapter->get('Test2'));

$Adapter = Cache::createInstance(Cache::TYPE_MEMCACHED);
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');
//$Adapter->set('Test3', 'Value3', 100);
//var_dump($Adapter->get('Test3'));
$FacadeBenchmark->enableOutput();

// #####################################################################################################################
// EXIT
// #####################################################################################################################
$WallTime->printBenchmark('WallTime');
