<?php

namespace PRECAST\Vendor\Factory\Package;


use PRECAST\Vendor\Factory\AbstractPackage;
use PRECAST\Vendor\Factory\AdapterInterface;
use PRECAST\Vendor\Factory\Contract\FileSystemInterface;

class FileSystem extends AbstractPackage
{
    /**
     * PackageInterface constructor.
     * @param AdapterInterface|null $AdapterInterface
     */
    public function __construct(AdapterInterface $AdapterInterface = null)
    {
        if ($AdapterInterface !== null && in_array(FileSystemInterface::class, class_implements($AdapterInterface))) {
            $this->useAdapter($AdapterInterface);
        }
        $this->defineInterface(FileSystemInterface::class);
        parent::__construct();
    }
}
