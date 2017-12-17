<?php
declare(strict_types=1);

use PRECAST\Benchmark;
use PRECAST\Vendor\Factory\Contract\LoggerInterface;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Benchmark.php';
$Benchmark = new Benchmark();

// #####################################################################################################################

require_once __DIR__ . DIRECTORY_SEPARATOR
    . 'Vendor' . DIRECTORY_SEPARATOR
    . 'Repository' . DIRECTORY_SEPARATOR
    . 'autoload.php';

$Benchmark->printBenchmark('Boot Autoloader');

// #####################################################################################################################

$Factory = new \PRECAST\Vendor\Factory();

var_dump( $Factory );

$Benchmark->printBenchmark('Boot Factory');

// #####################################################################################################################

$Adapter = $Factory->createAdapter(
    \PRECAST\Vendor\Factory\Contract\CacheInterface::class
);
var_dump( $Adapter );

$Benchmark->printBenchmark('Cache Adapter');

// #####################################################################################################################

$Adapter = $Factory->createAdapter(
    \PRECAST\Vendor\Factory\Contract\FileInterface::class
);
var_dump( $Adapter );

$Benchmark->printBenchmark('File Adapter');

// #####################################################################################################################

$Benchmark->printBenchmark('Finished');
