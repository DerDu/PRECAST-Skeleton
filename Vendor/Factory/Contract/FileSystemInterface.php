<?php

namespace Vendor\Factory\Contract;

use Vendor\Contract\ContainerInterface;
use Vendor\Factory\Container\FileSystem;

/**
 * Class FileSystem
 * @package Vendor\Factory\Container
 */
interface FileSystemInterface extends ContainerInterface
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
}
