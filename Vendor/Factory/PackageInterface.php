<?php

namespace PRECAST\Vendor\Factory;


interface PackageInterface
{
    /**
     * @return AdapterInterface
     */
    public function getPackage();
}
