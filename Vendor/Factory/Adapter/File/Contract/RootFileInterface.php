<?php

namespace PRECAST\Vendor\Factory\Adapter\File\Contract;


use PRECAST\Vendor\Factory\FactoryInterface;

/**
 * Interface RootFileInterface
 * @package PRECAST\Vendor\Factory\Adapter\File\Contract
 */
interface RootFileInterface extends FactoryInterface
{
    /**
     * @param string $Location
     * @return RootFileInterface
     */
    public function setFileLocation(string $Location): RootFileInterface;

    /**
     * @return string
     */
    public function getFileLocation(): string;

    /**
     * @return RootFileInterface
     */
    public function readFile();

    /**
     * @return RootFileInterface
     */
    public function writeFile();
}
