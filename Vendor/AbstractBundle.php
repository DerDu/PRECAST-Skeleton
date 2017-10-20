<?php

namespace Vendor;

/**
 * Class AbstractBundle
 * @package Vendor
 */
abstract class AbstractBundle
{
    /** @var AdapterInterface $Adapter */
    private $Adapter;

    /**
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->Adapter;
    }

    /**
     * @param AdapterInterface $Adapter
     * @return AbstractBundle
     */
    public function setAdapter(AdapterInterface $Adapter): AbstractBundle
    {
        $this->Adapter = $Adapter;
        return $this;
    }
}
