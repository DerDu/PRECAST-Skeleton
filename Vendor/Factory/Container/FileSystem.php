<?php

namespace Vendor\Factory\Container;

use Vendor\Factory\Contract\FileSystemInterface;

/**
 * Class FileSystem
 * @package Vendor\Factory\Container
 */
class FileSystem implements FileSystemInterface
{
    /** @var string $FileUri */
    private $FileUri = '';
    /** @var string $FileLocation */
    private $FileLocation = '';
    /** @var string $FileName */
    private $FileName = '';
    /** @var string $FileExtension */
    private $FileExtension = '';
    /** @var int $FileSize */
    private $FileSize = 0;

    /**
     * @return string
     */
    public function getFileUri(): string
    {
        return $this->FileUri;
    }

    /**
     * @return string
     */
    public function getFileLocation(): string
    {
        return $this->FileLocation;
    }

    /**
     * @param string $FileLocation
     * @return FileSystem
     */
    public function setFileLocation(string $FileLocation): FileSystem
    {
        $this->FileLocation = $FileLocation;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->FileName;
    }

    /**
     * @param string $FileName
     * @return FileSystem
     */
    public function setFileName(string $FileName): FileSystem
    {
        $this->FileName = $FileName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileExtension(): string
    {
        return $this->FileExtension;
    }

    /**
     * @param string $FileExtension
     * @return FileSystem
     */
    public function setFileExtension(string $FileExtension): FileSystem
    {
        $this->FileExtension = $FileExtension;
        return $this;
    }

    /**
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->FileSize;
    }
}
