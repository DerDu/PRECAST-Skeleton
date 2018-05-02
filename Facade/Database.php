<?php

namespace PRECAST\Facade;

use PRECAST\Vendor\Exception\AdapterException;
use PRECAST\Vendor\Exception\FactoryException;
use PRECAST\Vendor\Factory;
use PRECAST\Vendor\Factory\Adapter\Database\Contract\DoctrineDatabaseInterface;
use PRECAST\Vendor\Factory\Adapter\Database\Contract\EloquentDatabaseInterface;
use PRECAST\Vendor\Factory\Adapter\Database\Contract\RootDatabaseInterface;
use PRECAST\Vendor\Factory\Adapter\Fallback\Contract\RootFallbackInterface;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class Database
 * @package PRECAST\Facade
 */
class Database
{

    const TYPE_DOCTRINE = 0;
    const TYPE_ELOQUENT = 1;

    /**
     * @param int $Type
     * @return null|AdapterInterface
     * @throws AdapterException
     * @throws FactoryException
     */
    public static function createInstance(int $Type = Database::TYPE_DOCTRINE)
    {
        $Factory = new Factory();

        switch ($Type) {
            case self::TYPE_DOCTRINE:
                return $Factory->createAdapter(
                    RootDatabaseInterface::class,
                    DoctrineDatabaseInterface::class
                );
                break;
            case self::TYPE_ELOQUENT:
                return $Factory->createAdapter(
                    RootDatabaseInterface::class,
                    EloquentDatabaseInterface::class
                );
                break;
            default:
                return $Factory->createAdapter(
                    RootDatabaseInterface::class,
                    RootFallbackInterface::class
                );
                break;
        }
    }
}
