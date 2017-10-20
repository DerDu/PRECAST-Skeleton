<?php

namespace Vendor;

/**
 * Class AbstractFactory
 * @package Vendor
 */
abstract class AbstractFactory implements FactoryInterface
{
    /** @var bool $useMockUp */
    private static $useMockUp = false;
    /**
     * @var AdapterInterface
     */
    private $Adapter;

    /**
     * AbstractFactory constructor.
     * @param AdapterInterface $Adapter
     */
    public function __construct(AdapterInterface $Adapter)
    {
        print __METHOD__ . PHP_EOL;
        $this->Adapter = $Adapter->createAdapter();
    }

    /**
     * @return bool
     */
    public static function isUseMockUp(): bool
    {
        return self::$useMockUp;
    }

    /**
     * @return AdapterInterface
     */
    public function getAdapter(): AdapterInterface
    {
        print __METHOD__ . PHP_EOL;
        return $this->Adapter;
    }

    /**
     * @param bool $useMockUp
     */
    public static function setUseMockUp(bool $useMockUp)
    {
        self::$useMockUp = $useMockUp;
    }
}
