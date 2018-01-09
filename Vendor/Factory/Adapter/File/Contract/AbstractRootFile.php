<?php

namespace PRECAST\Vendor\Factory\Adapter\File\Contract;

/**
 * Class AbstractFile
 * @package PRECAST\Vendor\Factory\Contract
 */
abstract class AbstractRootFile implements RootFileInterface
{
    /** @var null|string $FileLocation */
    private $FileLocation = null;
    /** @var null|mixed $FileContent */
    private $FileContent = null;

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
    public function setFileLocation(string $Location): RootFileInterface
    {
        $this->FileLocation = $Location;
        return $this;
    }

    /**
     * @return mixed|null
     */
    protected function getFileContent()
    {
        return $this->FileContent;
    }

    /**
     * @param mixed|null $FileContent
     * @return RootFileInterface
     */
    protected function setFileContent($FileContent): RootFileInterface
    {
        $this->FileContent = $FileContent;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function readFile()
    {
        $this->setFileContent(
            file_get_contents( $this->getFileLocation() )
        );
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function writeFile()
    {
        file_put_contents(
            $this->getFileLocation(),
            $this->getFileContent()
        );
        return $this;
    }
}
