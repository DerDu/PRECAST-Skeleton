<?php

namespace PRECAST\Vendor\Factory\Contract;

/**
 * Interface FileSystemInterface
 * @package PRECAST\Vendor\Factory\Contract
 */
interface FileSystemInterface
{

    /**
     * @param string $Name
     * @return FileSystemInterface
     */
    public function searchDirectory(string $Name): FileSystemInterface;

    /**
     * Accepts glob, string, or regex
     *
     * @param string $Name
     * @return FileSystemInterface
     */
    public function findFile(string $Name): FileSystemInterface;

    /**
     * @return string
     */
    public function getFile(): string;

    /**
     * @return array
     */
    public function getFileList(): array;
}
