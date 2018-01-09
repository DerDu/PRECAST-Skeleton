<?php

namespace PRECAST\Vendor\Factory\Adapter\File;


use PRECAST\Vendor\Factory\Adapter\File\Contract\AbstractRootFile;
use PRECAST\Vendor\Factory\Adapter\File\Contract\TplFileInterface;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class TplFile
 * @package PRECAST\Vendor\Factory\Adapter\File
 */
class TplFile extends AbstractRootFile implements AdapterInterface, TplFileInterface
{
    /**
     * @inheritDoc
     */
    public function readFile(): TplFileInterface
    {
        parent::readFile();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function writeFile(): TplFileInterface
    {
        parent::writeFile();
        return $this;
    }


}