<?php

namespace PRECAST\Vendor\Factory;

/**
 * Interface PackageInterface
 * @package PRECAST\Vendor\Factory
 */
interface PackageInterface
{
    /**
     * @return AdapterInterface
     */
    public function getPackage();
}
