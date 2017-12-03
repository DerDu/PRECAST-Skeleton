<?php

namespace PRECAST\Vendor\Factory\Adapter\Generic;

use PRECAST\Vendor\Factory\AbstractAdapter;
use PRECAST\Vendor\Factory\Contract\ConfigurationInterface;
use PRECAST\Vendor\Factory\Contract\FileInterface;

/**
 * Class PrecastConfiguration
 * @package PRECAST\Vendor\Factory\Adapter\Generic
 */
class PrecastConfiguration extends AbstractAdapter implements ConfigurationInterface
{
    /** @var null|FileInterface $File */
    private $File = null;

    /**
     * @param FileInterface $File
     */
    public function loadFile(FileInterface $File)
    {
        $this->File = $File;
    }

    /**
     * @return bool
     */
    public function saveFile(): bool
    {
        // TODO: Implement saveConfiguration() method.
    }

    /**
     * @param string[] $Path
     * @return mixed
     */
    public function getValue(string ...$Path)
    {
        // TODO: Implement getValue() method.
    }

    /**
     * @param mixed $Value
     * @param string[] ...$Path
     * @return ConfigurationInterface
     */
    public function setValue($Value, string ...$Path): ConfigurationInterface
    {
        // TODO: Implement setValue() method.
    }
}
