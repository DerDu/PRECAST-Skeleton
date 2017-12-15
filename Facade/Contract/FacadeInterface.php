<?php

namespace PRECAST\Facade\Contract;

use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Interface FacadeInterface
 * @package PRECAST\Facade
 */
interface FacadeInterface
{
    /**
     * @param FacadeOption|null $FacadeOption
     * @return null|AdapterInterface
     */
    public static function Package(FacadeOption $FacadeOption = null);
}
