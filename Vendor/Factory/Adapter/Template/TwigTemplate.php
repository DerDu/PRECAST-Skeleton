<?php

namespace PRECAST\Vendor\Factory\Adapter\Template;


use PRECAST\Vendor\Factory\Adapter\File\TwigFile;
use PRECAST\Vendor\Factory\Adapter\Template\Contract\RootTemplateInterface;
use PRECAST\Vendor\Factory\AdapterInterface;

/**
 * Class TwigTemplate
 * @package PRECAST\Vendor\Factory\Adapter\Template
 */
class TwigTemplate extends TwigFile implements AdapterInterface, RootTemplateInterface
{

}
