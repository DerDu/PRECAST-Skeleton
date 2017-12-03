<?php

use PRECAST\Benchmark;
use PRECAST\Environment\Environment;
use PRECAST\Facade\Cache;
use PRECAST\Facade\Configuration;
use PRECAST\Facade\FileSystem;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Benchmark.php';

require_once __DIR__ . DIRECTORY_SEPARATOR
    . 'Vendor' . DIRECTORY_SEPARATOR
    . 'Repository' . DIRECTORY_SEPARATOR
    . 'autoload.php';

$Benchmark = new Benchmark();

// #####################################################################################################################

Environment::setEnvironment(Environment::USE_DEVELOPMENT);

$Benchmark->printBenchmark('Setup Environment: '. Environment::getEnvironment() );

// #####################################################################################################################

$Whoops = new \Whoops\Run;
$Whoops->pushHandler(new \Whoops\Handler\PlainTextHandler());
$Whoops->register();

$Benchmark->printBenchmark('Boot Error Handler');

// #####################################################################################################################

$Package = FileSystem::Package();

$Benchmark->printBenchmark('Test FileSystem');

// #####################################################################################################################

$Package = Cache::Package();

$Benchmark->printBenchmark('Test Cache');

// #####################################################################################################################

$Configuration = Environment::getConfigurationFile( 'Cache.yaml' );

$Factory = Configuration::Package();

$Benchmark->printBenchmark('Test Configuration');

// #####################################################################################################################
