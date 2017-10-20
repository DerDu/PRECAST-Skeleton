<?php

namespace Vendor\Factory\MockUpAdapter;

use Vendor\AbstractAdapter;
use Vendor\AdapterInterface;

/**
 * Class DatabaseAdapter
 * @package Vendor\Factory\MockUpAdapter
 */
class DatabaseAdapter extends AbstractAdapter implements AdapterInterface
{
    /**
     * @return AdapterInterface
     */
    public function createAdapter(): AdapterInterface
    {
        print __METHOD__ . PHP_EOL;
        return $this;
    }
}
