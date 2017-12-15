<?php

namespace PRECAST\Vendor\Factory\Adapter\FileType;

use PRECAST\Vendor\Factory\AbstractAdapter;
use PRECAST\Vendor\Factory\Contract\FileInterface;

/**
 * Class AbstractFileType
 * @package PRECAST\Vendor\Factory\Adapter\FileType
 */
abstract class AbstractFileType extends AbstractAdapter
{
    /** @var null|string $Uri */
    private $Uri = null;
    /** @var null|string $Content */
    private $Content = null;

    /**
     * @param string $Uri
     * @return FileInterface
     */
    public function loadFile(string $Uri): FileInterface
    {
        $this->Uri = $Uri;
        return $this;
    }

    /**
     * @param null|string $Uri
     * @return bool
     */
    public function saveFile(string $Uri = null): bool
    {
        // TODO: Implement saveFile() method.
    }

    /**
     * @return string
     */
    public function getFileUri(): string
    {
        // TODO: Implement getFileUri() method.
    }

    /**
     * @return string
     */
    public function getFileLocation(): string
    {
        return $this->Uri;
    }

    /**
     * @param string $FileLocation
     * @return FileInterface
     */
    public function setFileLocation(string $FileLocation): FileInterface
    {
        // TODO: Implement setFileLocation() method.
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        // TODO: Implement getFileName() method.
    }

    /**
     * @param string $FileName
     * @return FileInterface
     */
    public function setFileName(string $FileName): FileInterface
    {
        // TODO: Implement setFileName() method.
    }

    /**
     * @return string
     */
    public function getFileExtension(): string
    {
        // TODO: Implement getFileExtension() method.
    }

    /**
     * @param string $FileExtension
     * @return FileInterface
     */
    public function setFileExtension(string $FileExtension): FileInterface
    {
        // TODO: Implement setFileExtension() method.
    }

    /**
     * @return int
     */
    public function getFileSize(): int
    {
        // TODO: Implement getFileSize() method.
    }

    /**
     * @return string
     */
    public function getFileContent(): string
    {
        return $this->Content;
    }

    /**
     * @param string $Content
     * @return FileInterface
     */
    public function setFileContent(string $Content): FileInterface
    {
        $this->Content = $Content;
        return $this;
    }
}
