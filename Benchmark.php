<?php
namespace PRECAST;

/**
 * Class Benchmark
 * @package PRECAST
 */
class Benchmark
{
    private $Start = null;
    private $Stop = null;

    /**
     * Benchmark constructor.
     */
    public function __construct()
    {
        $this->Start = getrusage();
    }

    public function printBenchmark($Description = '')
    {
        $this->Stop = getrusage();

        if( $Description ) {
            echo PHP_EOL.$Description.PHP_EOL;
        }

        echo PHP_EOL;
        echo "This process used " . $this->getBenchmark($this->Stop, $this->Start, "utime") .
            " ms for its computations\n";
        echo "It spent " . $this->getBenchmark($this->Stop, $this->Start, "stime") .
            " ms in system calls\n";
        echo PHP_EOL;

        $this->Start = getrusage();
    }

    /**
     * @param $ru
     * @param $rus
     * @param $index
     * @return int
     */
    private function getBenchmark($ru, $rus, $index) {
        return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
            -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
    }
}
