<?php

namespace PRECAST\Vendor\Factory\Adapter\Fallback;


use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;
use PRECAST\Vendor\Factory\Adapter\File\Contract\AbstractRootFile;
use PRECAST\Vendor\Factory\Adapter\File\Contract\RootFileInterface;

/**
 * Class FallbackFile
 * @package PRECAST\Vendor\Factory\Adapter\Fallback
 */
class FallbackFile extends AbstractRootFile implements RootFallbackInterface
{
    /**
     * @inheritDoc
     */
    public function readFile(): RootFileInterface
    {
        // TODO: Implement readFile() method.
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function writeFile(): RootFileInterface
    {
        // TODO: Implement writeFile() method.
        return $this;
    }

}
