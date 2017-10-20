<?php

namespace Vendor\Adapter;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Vendor\AbstractAdapter;
use Vendor\AdapterInterface;
use Vendor\Bundle\DatabaseInterface;

/**
 * Class DoctrineAdapter
 * @package Vendor\Adapter
 */
class DoctrineAdapter extends AbstractAdapter implements DatabaseInterface
{
    /**
     * @return AdapterInterface
     */
    public function createAdapter(): AdapterInterface
    {
        // TODO: Implement createAdapter() method.
        print __METHOD__ . PHP_EOL;

// Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);

// database configuration parameters
        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/db.sqlite',
        );

// obtaining the entity manager
        $entityManager = EntityManager::create($conn, $config);

        $this->setRawVendor($entityManager);


        return $this;
    }

    public function connectDatabase()
    {

    }
}
