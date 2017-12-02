<?php

namespace PRECAST\Vendor\Factory\Package;

use PRECAST\Vendor\Factory\AbstractPackage;
use PRECAST\Vendor\Factory\AdapterInterface;
use PRECAST\Vendor\Factory\Contract\FileSystemInterface;

/**
 * Class FileSystem
 * @package PRECAST\Vendor\Factory\Package
 */
class FileSystem extends AbstractPackage
{
    /**
     * PackageInterface constructor.
     * @param AdapterInterface|null $Adapter
     */
    public function __construct(AdapterInterface $Adapter = null)
    {
        $this->defineInterface(FileSystemInterface::class);
        parent::__construct($Adapter);
    }

    /**
     * @return null|FileSystemInterface
     */
    public function getPackage(): FileSystemInterface
    {
        /** @var FileSystemInterface $Adapter */
        $Adapter = parent::getAdapter();
        return $Adapter;
    }
}
