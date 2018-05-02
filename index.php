<?php
declare(strict_types=1);

use PRECAST\Benchmark;
use PRECAST\Environment\Environment;
use PRECAST\Facade\Cache;
use PRECAST\Facade\Database;
use PRECAST\Facade\File;
use PRECAST\Facade\Template;
use PRECAST\Vendor\Factory;
use PRECAST\Vendor\Factory\Adapter\Cache\Contract\RootCacheInterface;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Benchmark.php';

print '<pre>';

$WallTime = new Benchmark();
$Benchmark = new Benchmark();

// #####################################################################################################################
// Setup Autoloader
require_once __DIR__ . DIRECTORY_SEPARATOR
    . 'Vendor' . DIRECTORY_SEPARATOR
    . 'Repository' . DIRECTORY_SEPARATOR
    . 'autoload.php';
// #####################################################################################################################

// #####################################################################################################################
// Setup/WarmUp Error Handler
$Whoops = new \Whoops\Run;
$Whoops->pushHandler(new \Whoops\Handler\PlainTextHandler());
$Whoops->register();
// #####################################################################################################################

// #####################################################################################################################
// WarmUp Factory
$Factory = new Factory();
var_dump($Factory->getAdapters());
var_dump($Factory->getFallbackAdapters());

var_dump(
    $Factory->createAdapter(
        Factory\Adapter\Fallback\Contract\RootFallbackInterface::class,
        Factory\Adapter\Fallback\Contract\RootApiGeneratorInterface::class
    )
);

// #####################################################################################################################

// #####################################################################################################################
// WarmUp Environment
$Environment = new Environment();
//var_dump( $Environment->getConfiguration() );
// #####################################################################################################################

//Environment::configureMapping( RootCacheInterface::class, 'Cache' );
//Environment::configureMapping( RootTemplateInterface::class, 'Template' );

$Benchmark->printBenchmark('Setup Application');

// #####################################################################################################################
// FACADE TEST
// #####################################################################################################################
$FacadeBenchmark = new Benchmark();
//$FacadeBenchmark->disableOutput();

/**
 * Template
 */
Benchmark::Log('Template');

$Adapter = Template::createInstance('Test.twig');
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = Template::createInstance('Test.tpl');
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = Template::createInstance('Test.blade');
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = Template::createInstance('Test.blade.php', Template::TYPE_BLADE);
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = Template::createInstance('-1');
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

/**
 * Cache
 */
Benchmark::Log('Cache');

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

//$Adapter = Cache::createInstance(Cache::TYPE_ZEND_MEMORY);
//$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');
//$Adapter->set('Test4', 'Value4', 100);
//var_dump($Adapter->get('Test4'));

//$Adapter = Cache::createInstance(Cache::TYPE_MEM_STATIC);
//$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');
//$Adapter->set('Test5', 'Value5', 100);
//var_dump($Adapter->get('Test5'));

$Adapter = Cache::createInstance(-1);
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

/**
 * File
 */
Benchmark::Log('File');

$Adapter = File::createInstance('Test.yaml');
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = File::createInstance('Test.twig');
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = File::createInstance('Test.tpl');
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = File::createInstance('Test.blade');
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = File::createInstance('Test.blade.php', File::TYPE_BLADE);
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = File::createInstance('-1');
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

/**
 * Database
 */
Benchmark::Log('Database');

$Adapter = Database::createInstance(Database::TYPE_DOCTRINE);
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = Database::createInstance(Database::TYPE_ELOQUENT);
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');

$Adapter = Database::createInstance(-1);
$FacadeBenchmark->printBenchmark(get_class($Adapter) . ' Facade');


//$FacadeBenchmark->enableOutput();
// #####################################################################################################################
// EXIT
// #####################################################################################################################
$WallTime->printBenchmark('WallTime');
