<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Benchmark.php';

$Benchmark = new \PRECAST\Benchmark();
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

$Benchmark->printBenchmark('Boot Error Handler');

// #####################################################################################################################

\PRECAST\Environment\Environment::setEnvironment(\PRECAST\Environment\Environment::USE_DEVELOPMENT);

$Benchmark->printBenchmark('Setup Environment');

// #####################################################################################################################

$Factory = \PRECAST\Facade\FileSystem::Package();

$Benchmark->printBenchmark('Test FileSystem');

// #####################################################################################################################

$Factory = \PRECAST\Facade\Cache::Package();

$Benchmark->printBenchmark('Test Cache');

// #####################################################################################################################

$Factory = \PRECAST\Facade\Configuration::Package();

$Benchmark->printBenchmark('Test Configuration');

// #####################################################################################################################

$Benchmark->printBenchmark('Exit');
