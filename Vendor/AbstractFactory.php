<?php

namespace Vendor;

use Vendor\Contract\AdapterInterface;
use Vendor\Contract\FactoryInterface;

/**
 * Class AbstractFactory
 * @package Vendor\Factory
 */
class AbstractFactory implements FactoryInterface
{
    /** @var null|AdapterInterface $Adapter */
    private $Adapter = null;

    /**
     * @param AdapterInterface $Adapter
     * @return FactoryInterface
     */
    public function useAdapter(AdapterInterface $Adapter) : FactoryInterface
    {
        $this->Adapter = $Adapter;
        return $this;
    }

    /**
     * @return null|AdapterInterface
     */
    protected function getAdapter()
    {
        return $this->Adapter;
    }
}
