<?php

namespace Vendor\Bundle;

use Vendor\AdapterInterface;

/**
 * Interface TemplateInterface
 * @package Vendor\Bundle
 */
interface TemplateInterface extends AdapterInterface
{
    /**
     * @param string $FileLocation
     * @return TemplateInterface
     */
    public function loadFile($FileLocation): TemplateInterface;

    /**
     * @param string $Identifier
     * @param mixed $Value
     * @return TemplateInterface
     */
    public function setVariable($Identifier, $Value): TemplateInterface;
}
