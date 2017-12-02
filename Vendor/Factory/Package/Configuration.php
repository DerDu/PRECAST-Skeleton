<?php

namespace PRECAST\Vendor\Factory\Package;


use PRECAST\Vendor\Factory\AbstractPackage;
use PRECAST\Vendor\Factory\AdapterInterface;
use PRECAST\Vendor\Factory\Contract\ConfigurationInterface;

/**
 * Class Configuration
 * @package PRECAST\Vendor\Factory\Package
 */
class Configuration extends AbstractPackage
{
    /**
     * PackageInterface constructor.
     * @param AdapterInterface|null $Adapter
     */
    public function __construct(AdapterInterface $Adapter = null)
    {
        $this->defineInterface(ConfigurationInterface::class);
        parent::__construct($Adapter);
    }

    /**
     * @return null|ConfigurationInterface
     */
    public function getPackage(): ConfigurationInterface
    {
        /** @var ConfigurationInterface $Adapter */
        $Adapter = parent::getAdapter();
        return $Adapter;
    }

}
