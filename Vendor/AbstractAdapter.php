<?php

namespace Vendor;

/**
 * Class AbstractAdapter
 * @package Vendor
 */
abstract class AbstractAdapter implements AdapterInterface
{
    /** @var null|mixed $rawVendor */
    private $rawVendor = null;

    /**
     * @return null|mixed
     */
    public function getRawVendor()
    {
        return $this->rawVendor;
    }

    /**
     * @param null|mixed $rawVendor
     */
    public function setRawVendor($rawVendor)
    {
        $this->rawVendor = $rawVendor;
    }
}
