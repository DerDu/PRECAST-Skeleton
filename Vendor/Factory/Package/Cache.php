<?php

namespace PRECAST\Vendor\Factory\Package;

use PRECAST\Vendor\Factory\AbstractPackage;
use PRECAST\Vendor\Factory\AdapterInterface;
use PRECAST\Vendor\Factory\Contract\CacheInterface;

/**
 * Class Cache
 * @package PRECAST\Vendor\Factory\Package
 */
class Cache extends AbstractPackage
{
    /**
     * PackageInterface constructor.
     * @param AdapterInterface|null $Adapter
     */
    public function __construct(AdapterInterface $Adapter = null)
    {
        $this->defineInterface(CacheInterface::class);
        parent::__construct($Adapter);
    }

    /**
     * @return null|CacheInterface
     */
    public function getPackage(): CacheInterface
    {
        /** @var CacheInterface $Adapter */
        $Adapter = parent::getAdapter();
        return $Adapter;
    }
}
