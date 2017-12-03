<?php

namespace PRECAST\Vendor\Factory\Package;

use PRECAST\Vendor\Factory\AbstractPackage;
use PRECAST\Vendor\Factory\AdapterInterface;
use PRECAST\Vendor\Factory\Contract\FileInterface;

/**
 * Class File
 * @package PRECAST\Vendor\Factory\Package
 */
class File extends AbstractPackage
{
    /**
     * PackageInterface constructor.
     * @param AdapterInterface|null $Adapter
     */
    public function __construct(AdapterInterface $Adapter = null)
    {
        $this->defineInterface(FileInterface::class);
        parent::__construct($Adapter);
    }

    /**
     * @return null|FileInterface
     */
    public function getPackage(): FileInterface
    {
        /** @var FileInterface $Adapter */
        $Adapter = parent::getAdapter();
        return $Adapter;
    }
}
