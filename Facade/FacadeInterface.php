<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Interface FacadeInterface
 * @package PRECAST\Facade
 */
interface FacadeInterface
{
    /**
     * @return null|AdapterInterface
     */
    public static function Package();
}
