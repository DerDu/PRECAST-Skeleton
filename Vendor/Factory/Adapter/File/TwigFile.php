<?php

namespace PRECAST\Vendor\Factory\Adapter\File;


use PRECAST\Vendor\Factory\Adapter\File\Contract\AbstractRootFile;
use PRECAST\Vendor\Factory\Adapter\File\Contract\TwigFileInterface;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class TwigFile
 * @package PRECAST\Vendor\Factory\Adapter\File
 */
class TwigFile extends AbstractRootFile implements AdapterInterface, TwigFileInterface
{
    /**
     * @inheritDoc
     */
    public function readFile(): TwigFileInterface
    {
        parent::readFile();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function writeFile(): TwigFileInterface
    {
        parent::writeFile();
        return $this;
    }
}
