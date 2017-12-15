<?php

namespace PRECAST\Vendor\Factory;

/**
 * Class AbstractAdapter
 * @package PRECAST\Vendor\Factory
 */
abstract class AbstractAdapter implements AdapterInterface
{
    /** @var null|mixed $rawVendor */
    private $rawVendor = null;

    /**
     * @return null|mixed
     */
    protected function getRawVendor()
    {
        return $this->rawVendor;
    }

    /**
     * @param null|mixed $rawVendor
     */
    protected function setRawVendor($rawVendor)
    {
        $this->rawVendor = $rawVendor;
    }
}
