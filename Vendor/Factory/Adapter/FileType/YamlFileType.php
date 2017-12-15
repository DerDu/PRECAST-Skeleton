<?php

namespace PRECAST\Vendor\Factory\Adapter\FileType;

use PRECAST\Vendor\Factory\Contract\FileInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlFileType
 * @package PRECAST\Vendor\Factory\Adapter
 */
class YamlFileType extends AbstractFileType implements FileInterface
{
    /**
     * @param string $Uri
     * @return FileInterface
     */
    public function loadFile(string $Uri): FileInterface
    {
        parent::loadFile($Uri);

        $this->setFileContent(
            Yaml::parse(file_get_contents($this->getFileLocation()))
        );

        return $this;
    }
}
