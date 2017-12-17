<?php

namespace PRECAST\Vendor\Factory\Contract;


use PRECAST\Vendor\Factory\FactoryInterface;

/**
 * Interface FileInterface
 * @package PRECAST\Vendor\Factory\Contract
 */
interface FileInterface extends FactoryInterface
{
    /**
     * @param string $Location
     * @return FileInterface
     */
    public function setFileLocation(string $Location): FileInterface;

    /**
     * @return string
     */
    public function getFileLocation(): string;
}
