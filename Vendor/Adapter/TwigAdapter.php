<?php

namespace Vendor\Adapter;

use Vendor\AbstractAdapter;
use Vendor\AdapterInterface;
use Vendor\Bundle\TemplateInterface;

/**
 * Class TwigAdapter
 * @package Vendor\Adapter
 */
class TwigAdapter extends AbstractAdapter implements TemplateInterface
{
    /**
     * @return AdapterInterface
     */
    public function createAdapter(): AdapterInterface
    {
        print __METHOD__ . PHP_EOL;
        return $this;
    }

    /**
     * @param string $FileLocation
     * @return TemplateInterface
     */
    public function loadFile($FileLocation): TemplateInterface
    {
        print __METHOD__ . PHP_EOL;
        return $this;
    }

    /**
     * @param string $Identifier
     * @param mixed $Value
     * @return TemplateInterface
     */
    public function setVariable($Identifier, $Value): TemplateInterface
    {
    }


}
