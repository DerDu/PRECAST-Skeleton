<?php

namespace PRECAST\Vendor\Factory\Adapter;

use PRECAST\Vendor\Factory\AbstractAdapter;
use PRECAST\Vendor\Factory\Contract\FileSystemInterface;

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
     * @return FileSystemInterface
     */
    public function setFileLocation(string $FileLocation): FileSystemInterface
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
     * @return FileSystemInterface
     */
    public function setFileName(string $FileName): FileSystemInterface
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
     * @return FileSystemInterface
     */
    public function setFileExtension(string $FileExtension): FileSystemInterface
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
     * @return FileSystemInterface
     */
    public function setFileContent(string $Content): FileSystemInterface
    {
        // TODO: Implement setFileContent() method.
    }

}
