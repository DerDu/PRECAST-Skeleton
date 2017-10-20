<?php

namespace Vendor\Helper;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser;

/**
 * Class FileLocator
 * @package Vendor\Helper
 */
class FileLocator
{
    const MIME_TYPE_TEXT_PLAIN = 'text/plain';

    /** @var null|SplFileInfo $File */
    private $File = null;

    /**
     * FileLocator constructor.
     * @param string $Location
     * @throws \Exception
     */
    public function __construct($Location)
    {

        $Finder = (new Finder())->files();
        $Finder->name(basename($Location));
        $Finder->in(dirname($Location));
        if ($Finder->count() < 1) {
            throw new \Exception('File (' . $Location . ') not found!');
        }
        if ($Finder->count() > 1) {
            throw new \Exception('Multiple files (' . $Location . ') found!');
        }
        /** @var SplFileInfo $File */
        foreach ($Finder as $File) {
            $this->File = $File;
        }
    }

    /**
     * @return string
     */
    public function getFileMimeType()
    {
        return MimeTypeGuesser::getInstance()->guess($this->File);
    }

    /**
     * @return string
     */
    public function getFileExtension()
    {
        return $this->File->getExtension();
    }
}
