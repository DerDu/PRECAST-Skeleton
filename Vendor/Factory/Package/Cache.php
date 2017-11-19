<?php

namespace PRECAST\Vendor\Factory\Package;

use PRECAST\Vendor\Factory\AbstractPackage;
use PRECAST\Vendor\Factory\AdapterInterface;
use PRECAST\Vendor\Factory\Contract\CacheInterface;
use PRECAST\Vendor\Factory\PackageInterface;

/**
 * Class Cache
 * @package PRECAST\Vendor\Factory\Package
 */
class Cache extends AbstractPackage implements PackageInterface
{
    /**
     * PackageInterface constructor.
     * @param AdapterInterface|null $AdapterInterface
     */
    public function __construct(AdapterInterface $AdapterInterface = null)
    {
        if ($AdapterInterface !== null && in_array(CacheInterface::class, class_implements($AdapterInterface))) {
            $this->useAdapter($AdapterInterface);
        }
        $this->defineInterface(CacheInterface::class);
        parent::__construct();
    }

    /**
     * @return null|CacheInterface
     */
    public function getPackage() : CacheInterface
    {
        return parent::getAdapter();
    }
}
