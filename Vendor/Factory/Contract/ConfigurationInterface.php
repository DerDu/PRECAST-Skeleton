<?php

namespace PRECAST\Vendor\Factory\Contract;

/**
 * Interface ConfigurationInterface
 * @package PRECAST\Vendor\Factory\Contract
 */
interface ConfigurationInterface
{
    /**
     * @param FileInterface $File
     */
    public function loadFile(FileInterface $File);

    /**
     * @return bool
     */
    public function saveFile(): bool;

    /**
     * @param string[] $Path
     * @return mixed
     */
    public function getValue(string ...$Path);

    /**
     * @param mixed $Value
     * @param string[] ...$Path
     * @return ConfigurationInterface
     */
    public function setValue($Value, string ...$Path): ConfigurationInterface;
}
