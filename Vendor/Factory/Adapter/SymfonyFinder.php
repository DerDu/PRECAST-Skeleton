<?php

namespace PRECAST\Vendor\Factory\Adapter;

use PRECAST\Vendor\Factory\AbstractAdapter;
use PRECAST\Vendor\Factory\Contract\FileSystemInterface;
use PRECAST\Vendor\Factory\Package\FileSystem;

/**
 * Class SymfonyFinder
 * @package PRECAST\Vendor\Factory\Adapter
 */
class SymfonyFinder extends AbstractAdapter implements FileSystemInterface
{
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
        // TODO: Implement getFileLocation() method.
    }

    /**
     * @param string $FileLocation
     * @return FileSystem
     */
    public function setFileLocation(string $FileLocation): FileSystem
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
     * @return FileSystem
     */
    public function setFileName(string $FileName): FileSystem
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
     * @return FileSystem
     */
    public function setFileExtension(string $FileExtension): FileSystem
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
        // TODO: Implement getFileContent() method.
    }

    /**
     * @param string $Content
     * @return FileSystem
     */
    public function setFileContent(string $Content): FileSystem
    {
        // TODO: Implement setFileContent() method.
    }

}
