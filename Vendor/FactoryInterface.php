<?php

namespace Vendor;

/**
 * Interface FactoryInterface
 * @package Vendor
 */
interface FactoryInterface extends VendorInterface
{
    /**
     * FactoryInterface constructor.
     * @param AdapterInterface $Adapter
     */
    public function __construct(AdapterInterface $Adapter);

    /**
     * @return AdapterInterface
     */
    public function getAdapter(): AdapterInterface;
}
