<?php

namespace PRECAST;

/**
 * Class Benchmark
 * @package PRECAST
 */
class Benchmark
{
    private static $Output = true;
    private $Start = null;
    private $WallTime = null;
    private $SplitTime = null;
    private $Stop = null;

    /**
     * Benchmark constructor.
     */
    public function __construct()
    {
        $this->Start = getrusage();
        $this->WallTime = microtime(true);
        $this->SplitTime = $this->WallTime;
    }

    /**
     * @param $Message
     */
    public static function Log($Message)
    {
        if (self::$Output) {
            self::echoRuler();
            echo print_r($Message, true);
            self::echoRuler();
        }
    }

    private static function echoRuler($Type = '#')
    {
        echo PHP_EOL . str_repeat($Type, 80) . PHP_EOL;
    }

    /**
     *
     */
    public function disableOutput()
    {
        self::$Output = false;
    }

    /**
     *
     */
    public function enableOutput()
    {
        self::$Output = true;
    }

    /**
     * @param string $Description
     */
    public function printBenchmark($Description)
    {
        $this->Stop = getrusage();
        if (self::$Output) {
            self::echoRuler('_');
            echo print_r($Description,true);
            self::echoRuler('~');
            echo "This process used " . $this->getBenchmark($this->Stop, $this->Start, "utime") .
                " ms for its computations" . PHP_EOL;
            echo "It spent " . $this->getBenchmark($this->Stop, $this->Start, "stime") .
                " ms in system calls" . PHP_EOL;
            echo "Section - Time elapsed " . $this->getWallTime(true) . 'ms' . PHP_EOL;
            echo "Overall - Time elapsed " . $this->getWallTime() . 'ms';
            self::echoRuler('^');
        }
        $this->Start = getrusage();
        $this->SplitTime = microtime(true);
    }

    /**
     * @param $ru
     * @param $rus
     * @param $index
     * @return int
     */
    private function getBenchmark($ru, $rus, $index)
    {
        return ($ru["ru_$index.tv_sec"] * 1000 + intval($ru["ru_$index.tv_usec"] / 1000))
            - ($rus["ru_$index.tv_sec"] * 1000 + intval($rus["ru_$index.tv_usec"] / 1000));
    }

    /**
     * @param bool $Split
     * @return float
     */
    private function getWallTime($Split = false)
    {
        if ($Split) {
            $Time = round(microtime(true) * 1000) - round($this->SplitTime * 1000);
        } else {
            $Time = round(microtime(true) * 1000) - round($this->WallTime * 1000);
        }
        return $Time;
    }
}
