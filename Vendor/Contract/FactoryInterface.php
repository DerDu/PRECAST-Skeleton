<?php

namespace Vendor\Contract;

/**
 * Interface FactoryInterface
 * @package Vendor\Contract
 */
interface FactoryInterface
{

    public function useAdapter(AdapterInterface $Adapter);
}
