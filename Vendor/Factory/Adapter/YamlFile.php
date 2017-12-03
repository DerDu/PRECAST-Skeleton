<?php

namespace PRECAST\Vendor\Factory\Adapter;


use PRECAST\Vendor\Factory\AbstractAdapter;
use PRECAST\Vendor\Factory\Contract\ConfigurationInterface;
use PRECAST\Vendor\Factory\Contract\FileInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlFile
 * @package PRECAST\Vendor\Factory\Adapter
 */
class YamlFile extends AbstractAdapter implements FileInterface
{

    private $Content = null;

    /**
     * @param string $Uri
     * @return ConfigurationInterface
     */
    public function loadFile($Uri): ConfigurationInterface
    {
        $this->Content = Yaml::parseFile( $Uri );
    }

    /**
     * @param null $Uri
     * @return bool
     */
    public function saveFile($Uri = null): bool
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
        // TODO: Implement getFileLocation() method.
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
        // TODO: Implement getFileContent() method.
    }

    /**
     * @param string $Content
     * @return FileInterface
     */
    public function setFileContent(string $Content): FileInterface
    {
        // TODO: Implement setFileContent() method.
    }


}
