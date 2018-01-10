<?php

namespace PRECAST\Vendor\Factory\Adapter\Fallback;


use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;
use PRECAST\Vendor\Factory\Adapter\File\Contract\AbstractRootFile;
use PRECAST\Vendor\Factory\Adapter\File\Contract\RootFileInterface;

/**
 * Class FallbackFile
 * @package PRECAST\Vendor\Factory\Adapter\Fallback
 */
class FallbackFile extends AbstractRootFile implements RootFileInterface, RootFallbackInterface
{
    /**
     * @inheritDoc
     */
    public function readFile(): RootFileInterface
    {
        parent::readFile();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function writeFile(): RootFileInterface
    {
        parent::writeFile();
        return $this;
    }

}
