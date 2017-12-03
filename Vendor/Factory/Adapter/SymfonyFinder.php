<?php

namespace PRECAST\Vendor\Factory\Adapter;

use PRECAST\Vendor\Factory\AbstractAdapter;
use PRECAST\Vendor\Factory\Contract\FileSystemInterface;
use Symfony\Component\Finder\Finder;

/**
 * Class SymfonyFinder
 * @package PRECAST\Vendor\Factory\Adapter
 */
class SymfonyFinder extends AbstractAdapter implements FileSystemInterface
{

    /** @var null|Finder $Vendor */
    private $Vendor = null;

    /**
     * SymfonyFinder constructor.
     */
    public function __construct()
    {
        $this->Vendor = new Finder();
        $this->Vendor
            ->files()
            ->followLinks()
            ->ignoreUnreadableDirs(true)
            ->ignoreVCS(true)
            ->ignoreDotFiles(true);
    }

    /**
     * @param string $Name
     * @return FileSystemInterface
     */
    public function searchDirectory(string $Name): FileSystemInterface
    {
        $this->Vendor->in($Name);
        return $this;
    }

    /**
     * Accepts glob, string, or regex
     *
     * @param string $Name
     * @return FileSystemInterface
     */
    public function findFile(string $Name): FileSystemInterface
    {
        $this->Vendor->name($Name);
        return $this;
    }

    /**
     * @return array|null
     */
    private function getIteratorList()
    {
        if ($this->Vendor->hasResults()) {
            $Result = [];
            foreach ( $this->Vendor as $Iterator ) {
                $Result[] = $Iterator;
            }
            return $Result;
        }
        return null;
    }
}
