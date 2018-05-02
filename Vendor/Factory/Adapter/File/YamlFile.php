<?php

namespace PRECAST\Vendor\Factory\Adapter\File;


use PRECAST\Vendor\Factory\Adapter\File\Contract\AbstractRootFile;
use PRECAST\Vendor\Factory\Adapter\File\Contract\YamlFileInterface;
use PRECAST\Vendor\Factory\AdapterInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlFile
 * @package PRECAST\Vendor\Factory\Adapter\File
 */
class YamlFile extends AbstractRootFile implements AdapterInterface, YamlFileInterface
{
    /** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * @inheritDoc
     */
    public function readFile(): YamlFileInterface
    {
        $this->setFileContent(
            Yaml::parseFile($this->getFileLocation())
        );
        return $this;
    }

    /** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * @inheritDoc
     */
    public function writeFile(): YamlFileInterface
    {
        file_put_contents(
            $this->getFileLocation(),
            Yaml::dump($this->getFileContent(), 4, 4, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK)
        );
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getFileContent(): array
    {
        return (array)parent::getFileContent();
    }
}
