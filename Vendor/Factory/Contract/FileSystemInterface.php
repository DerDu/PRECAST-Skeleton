<?php

namespace PRECAST\Vendor\Factory\Contract;

/**
 * Interface FileSystemInterface
 * @package PRECAST\Vendor\Factory\Contract
 */
interface FileSystemInterface
{
    /**
     * @return string
     */
    public function getFileUri(): string;

    /**
     * @return string
     */
    public function getFileLocation(): string;

    /**
     * @param string $FileLocation
     * @return FileSystemInterface
     */
    public function setFileLocation(string $FileLocation): FileSystemInterface;

    /**
     * @return string
     */
    public function getFileName(): string;

    /**
     * @param string $FileName
     * @return FileSystemInterface
     */
    public function setFileName(string $FileName): FileSystemInterface;

    /**
     * @return string
     */
    public function getFileExtension(): string;

    /**
     * @param string $FileExtension
     * @return FileSystemInterface
     */
    public function setFileExtension(string $FileExtension): FileSystemInterface;

    /**
     * @return int
     */
    public function getFileSize(): int;

    /**
     * @return string
     */
    public function getFileContent(): string;

    /**
     * @param string $Content
     * @return FileSystemInterface
     */
    public function setFileContent(string $Content): FileSystemInterface;
}
