<?php

namespace PRECAST\Vendor\Factory\Contract;

use PRECAST\Vendor\Factory\Package\FileSystem;

/**
 * Interface FileSystemInterface
 * @package Vendor\Factory\Contract
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
     * @return FileSystem
     */
    public function setFileLocation(string $FileLocation): FileSystem;

    /**
     * @return string
     */
    public function getFileName(): string;

    /**
     * @param string $FileName
     * @return FileSystem
     */
    public function setFileName(string $FileName): FileSystem;

    /**
     * @return string
     */
    public function getFileExtension(): string;

    /**
     * @param string $FileExtension
     * @return FileSystem
     */
    public function setFileExtension(string $FileExtension): FileSystem;

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
     * @return FileSystem
     */
    public function setFileContent(string $Content): FileSystem;
}
