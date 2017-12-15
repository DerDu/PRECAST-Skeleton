<?php

namespace PRECAST\Vendor\Factory\Package;

use PRECAST\Vendor\Factory\AbstractPackage;
use PRECAST\Vendor\Factory\AdapterInterface;
use PRECAST\Vendor\Factory\Contract\TemplateInterface;

/**
 * Class Template
 * @package PRECAST\Vendor\Factory\Package
 */
class Template extends AbstractPackage
{
    /**
     * Template constructor.
     * @param AdapterInterface|null $Adapter
     */
    public function __construct(AdapterInterface $Adapter = null)
    {
        $this->defineInterface(TemplateInterface::class);
        parent::__construct($Adapter);
    }

    /**
     * @return TemplateInterface
     */
    public function getPackage(): TemplateInterface
    {
        /** @var TemplateInterface $Adapter */
        $Adapter = parent::getAdapter();
        return $Adapter;
    }

}
