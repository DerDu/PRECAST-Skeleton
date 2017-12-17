<?php

namespace PRECAST\Vendor\Factory\Contract;

/**
 * Class AbstractFile
 * @package PRECAST\Vendor\Factory\Contract
 */
abstract class AbstractFile implements FileInterface
{
    /** @var null|string $FileLocation */
    private $FileLocation = null;

    /**
     * @inheritdoc
     */
    public function getFileLocation(): string
    {
        return $this->FileLocation;
    }

    /**
     * @inheritdoc
     */
    public function setFileLocation(string $Location): FileInterface
    {
        $this->FileLocation = $Location;
        return $this;
    }
}
