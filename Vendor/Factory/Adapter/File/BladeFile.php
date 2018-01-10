<?php

namespace PRECAST\Vendor\Factory\Adapter\File;


use PRECAST\Vendor\Factory\Adapter\File\Contract\AbstractRootFile;
use PRECAST\Vendor\Factory\Adapter\File\Contract\BladeFileInterface;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class BladeFile
 * @package PRECAST\Vendor\Factory\Adapter\File
 */
class BladeFile extends AbstractRootFile implements AdapterInterface, BladeFileInterface
{
    /**
     * @inheritDoc
     */
    public function readFile(): BladeFileInterface
    {
        parent::readFile();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function writeFile(): BladeFileInterface
    {
        parent::writeFile();
        return $this;
    }
}
