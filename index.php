<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'Benchmark.php';

$Benchmark = new \PRECAST\Benchmark();
// #####################################################################################################################

require_once __DIR__ . DIRECTORY_SEPARATOR
    . 'Vendor' . DIRECTORY_SEPARATOR
    . 'Repository' . DIRECTORY_SEPARATOR
    . 'autoload.php';

$Benchmark->printBenchmark( 'Boot Autoloader' );

$Factory = new PRECAST\Vendor\Factory\Package\FileSystem();
var_dump($Factory);
$Factory = new PRECAST\Vendor\Factory\Package\Cache();
var_dump($Factory);

//$Factory->getPackage()->setValue('Test1', 'Value1', 10);
var_dump(
    $Factory->getPackage()->getValue('Test1' )
);
// #####################################################################################################################

$Benchmark->printBenchmark( 'Test Factory' );
