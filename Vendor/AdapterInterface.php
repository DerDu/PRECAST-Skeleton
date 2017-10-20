<?php

namespace Vendor;

/**
 * Interface AdapterInterface
 * @package Vendor
 */
interface AdapterInterface extends VendorInterface
{
    /**
     * @return AdapterInterface
     */
    public function createAdapter(): AdapterInterface;

    /**
     * @return null|mixed
     */
    public function getRawVendor();

    /**
     * @param null|mixed $rawVendor
     */
    public function setRawVendor($rawVendor);
}
