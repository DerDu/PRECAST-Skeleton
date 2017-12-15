<?php

namespace PRECAST\Vendor\Factory\Contract;

/**
 * Interface FileInterface
 * @package PRECAST\Vendor\Factory\Contract
 */
interface FileInterface
{
    /**
     * @param string $Uri
     * @return FileInterface
     */
    public function loadFile(string $Uri): FileInterface;

    /**
     * @param null|string $Uri
     * @return bool
     */
    public function saveFile(string $Uri = null): bool;

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
     * @return FileInterface
     */
    public function setFileLocation(string $FileLocation): FileInterface;

    /**
     * @return string
     */
    public function getFileName(): string;

    /**
     * @param string $FileName
     * @return FileInterface
     */
    public function setFileName(string $FileName): FileInterface;

    /**
     * @return string
     */
    public function getFileExtension(): string;

    /**
     * @param string $FileExtension
     * @return FileInterface
     */
    public function setFileExtension(string $FileExtension): FileInterface;

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
     * @return FileInterface
     */
    public function setFileContent(string $Content): FileInterface;
}
