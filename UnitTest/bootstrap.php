<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'..' . DIRECTORY_SEPARATOR. 'Benchmark.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'TestHelper.php';

require_once __DIR__ . DIRECTORY_SEPARATOR. '..' . DIRECTORY_SEPARATOR
    . 'Vendor' . DIRECTORY_SEPARATOR
    . 'Repository' . DIRECTORY_SEPARATOR
    . 'autoload.php';

$Benchmark = new \PRECAST\Benchmark();

// #####################################################################################################################

\PRECAST\Environment\Environment::setEnvironment(\PRECAST\Environment\Environment::USE_TEST);

$Benchmark->printBenchmark('Setup Environment: '. \PRECAST\Environment\Environment::getEnvironment() );

// #####################################################################################################################

$Whoops = new \Whoops\Run;
$Whoops->pushHandler(new \Whoops\Handler\PlainTextHandler());
$Whoops->register();

$Benchmark->printBenchmark('Boot Error Handler');

// #####################################################################################################################
